const targets = Array.from(document.body.querySelectorAll('input[data-mapsfield=mapsfield]'));

let options = {};
let autoComplete = [];

const CreateNewEvent = (eventName) => {
  let event;

  if (typeof (Event) === 'function') {
    event = new Event(eventName);
  } else {
    event = document.createEvent('Event');
    event.initEvent(eventName, true, true);
  }

  return event;
};

const fillAddress = (fieldName) => {
  const event = new CreateNewEvent('change');
  const location = autoComplete[fieldName].getPlace();
  const components = location.address_components;
  const latField = document.getElementById(fieldName+'GoogleMapsLatField');
  const lngField = document.getElementById(fieldName+'GoogleMapsLngField');

  latField.setAttribute('value', location.geometry.location.lat());
  lngField.setAttribute('value', location.geometry.location.lng());

  components.forEach((component) => {
    component.types.forEach((type) => {
      const field = document.getElementById(fieldName + type);
      if (field) {
        field.setAttribute('value', component.long_name);
        field.dispatchEvent(event);
      }
    });
  });
};

const mountMapsField = (mapsfield) => {
  const fieldName = mapsfield.name;
  options = Object.assign(options, window[fieldName + 'Customisations']);
  autoComplete[fieldName] = new google.maps.places.Autocomplete(mapsfield, options);
  autoComplete[fieldName].addListener('place_changed', function(){
    fillAddress(fieldName)});
};

export default function() {
  targets.forEach(mountMapsField);
}
