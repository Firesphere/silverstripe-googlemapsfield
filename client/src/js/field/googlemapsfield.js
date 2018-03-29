const targets = document.body.querySelectorAll('input[data-mapsfield=mapsfield]');
const latField = document.getElementById('GoogleMapsLatField');
const lngField = document.getElementById('GoogleMapsLngField');

let options = {
  types: ['address']
};
let autoComplete;

const fillAddress = () => {
  const location = autoComplete.getPlace();
  const components = location.address_components;

  latField.setAttribute('value', location.geometry.location.lat());
  lngField.setAttribute('value', location.geometry.location.lng());

  components.forEach((component) => {
    let field = document.getElementById(component.types[0]);
    field.setAttribute('value', component.long_name);
  });
};

const mountMapsField = (mapsfield) => {
  options = Object.assign(options, window.customisations);
  autoComplete = new google.maps.places.Autocomplete(mapsfield, options);
  autoComplete.addListener('place_changed', fillAddress);
};

export default function() {
  targets.forEach(mountMapsField);
}