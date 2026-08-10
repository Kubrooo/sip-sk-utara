/**
 * Alpine.js Helper for Dispatching Modal Events
 */
export function toggleModal(name, state = true) {
    const eventName = state ? 'open-modal' : 'close-modal';
    window.dispatchEvent(new CustomEvent(eventName, { detail: name }));
}
