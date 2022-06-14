import { Controller } from '@hotwired/stimulus';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static targets = ['message']
    static values = {
        channel: String,
    }

    connect() {
      fetch(this.channelValue).then(function(){
        console.log("test");
      })
    }
}

