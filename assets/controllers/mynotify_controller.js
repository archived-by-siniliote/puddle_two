import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
  initialize() {
    // guarantees "this" refers to this object in _onConnect
    this._onConnect = this._onConnect.bind(this);
  }

  connect() {
    this.element.addEventListener('notify:connect', this._onConnect);
  }

  disconnect() {
    // You should always remove listeners when the controller is disconnected to avoid side effects
    this.element.removeEventListener('notify:connect', this._onConnect);
  }

  _onConnect(event) {
    // Event sources have just been created
    console.log(event.detail.eventSources);

    event.detail.eventSources.forEach((eventSource) => {
      eventSource.addEventListener('message', (event) => {
        console.log(event); // You can add custom behavior on each event source
      });
    });
  }
}
