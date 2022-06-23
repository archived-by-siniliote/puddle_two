import { Controller } from '@hotwired/stimulus';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static targets = [ "message", "template"];
    static values = {
      urlMercure: String,
    }

    connect() {
      this.es = new EventSource(this.urlMercureValue);
      this.es.onmessage = ({data}) => {
        const message = JSON.parse(data);
        this.templateTarget.content.querySelector("b").textContent = message.author.username
        this.templateTarget.content.querySelector("p").textContent = message.content
        this.element.insertAdjacentHTML("beforeend", this.templateTarget.innerHTML);
      }
    }

    submitForm(event){
      event.preventDefault();
      const data = {
        'content': this.messageTarget.value,
        'channel': event.params.id
      };

      fetch(event.params.url, {
        method: 'POST',
        body: JSON.stringify(data)
      }).then(() => {
        this.messageTarget.value = '';
      });
    }
}

