
// Add header and footer content // ------------------------------------------
fetch("./parts/header.html")
  .then(response => {
    return response.text()
  })
  .then(data => {
    document.querySelector("header").innerHTML = data;
  });

fetch("./parts/footer.html")
  .then(response => {
    return response.text()
  })
  .then(data => {
    document.querySelector("footer").innerHTML = data;
  });


// Animate with barba.js // --------------------------------------------------
barba.init();
// barba.init({
//     schema: {
//         prefix: 'data-custom',
//         wrapper: 'wrapper'
//       }
// })


// Leaflet.js // -------------------------------------------------------------
let map = L.map('map').setView([48.8534, 2.3488], 13);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
}).addTo(map);

let clicMarker;

let greenIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});
let purpleIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-violet.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

function onMapClick(e){
    if (clicMarker){
        map.removeLayer(clicMarker);
    }
    let myform = "<form id='myform' name='form' onsubmit='placeForm(event)'>" +
        "<label for='name'>Nom</label>" +
        "<input type='text' name='name' id='name'>"+ "<br>" +
        "<label for='type'>type</label>" +
        "<input type='text' name='type' id='type'>"+
        "<label for='address'>adresse</label>" +
        "<input type='text' name='address' id='address'>"+
        "<label for='city_id'>Arrondissement</label>" +
        "<input type='number' name='city_id' id='city_id'>"+
        "<input type='hidden' name='lat' id='lat' value='"+e.latlng.lat+"'>"+
        "<input type='hidden' name='lng' id='lng' value='"+e.latlng.lng+"'>"+
        "<button>Submit</button>" +
        "</form>"

    clicMarker = new L.marker(e.latlng, {draggable:true}).addTo(map).bindPopup(myform);
}

//Traitement form
function placeForm(event){
    event.preventDefault();
    let url = '/interactive_map/backend/action/create/createPlace.php';


    let data = new FormData(event.target);
    let value = Object.fromEntries(data.entries());

    console.log(value);

    fetch(url, {
        method:'POST',
        body: JSON.stringify(value),
        headers: {
            "Content-Type": "application/json; charset=UTF-8",
        }
    })
    .then((response)=>{
        return response.json();
    })
    .then((data)=>console.log(data))
}


function cityMarker(){
    url= 'http://localhost/interactive_map/backend/action/read/getCity.php';
    url2= `/interactive_map/backend/action/read/getCity.php`;
    fetch(url2,{
        method: 'POST',
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body:`cityId= 1`,
    })
    .then((response)=>response.text())
    .then((city)=> {
        cityObj = JSON.parse(city)
        L.marker([cityObj.lat,cityObj.lng], {icon:greenIcon}).addTo(map);
    })
    console.log();
}
async function showDistricts(){
    const response = await fetch("/interactive_map/backend/action/read/getDistrict.php");
    const districts = await response.json();
    console.log(districts);

    districts.forEach(function (district){
        console.log(district)
        L.marker([district.lat, district.lng],{icon:purpleIcon}).addTo(map)
            .bindPopup(district.name)
    });
}
// login // -------------------------------------------------------------




function openPopup(){
    document.getElementById("loginPopup").style.display = "block";
}

function closePopup(){
    document.getElementById("loginPopup").style.display = "none";
}

 function loginUser(event){
    event.preventDefault();
    // console.log(event);
    let url = '/interactive_map/backend/action/loginScript.php';

    let data = new FormData(event.target);
    let value = Object.fromEntries(data.entries());

    fetch(url, {
        method: 'POST',
        body: JSON.stringify(value),
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        }
    })
        .then((response)=> response.json())
        .then((data)=> {
            sessionStorage.setItem('user', JSON.stringify(data.response.user));
            // console.log(data.response.user)
        })


}
function userLogout(){
    if (sessionStorage.getItem('user')){
        sessionStorage.clear(); // vide toute la session
        // sessionStorage.removeItem('user'); supprime uniquement les données de l'utilisateur dans la session
    }
}


// L.marker([51.5, -0.09]).addTo(map)
//     .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
//     .openPopup();

// list // -------------------------------------------------------------------
class Card {
  constructor(title, text, img) {
    this.title = title;
    this.text = text;
    this.img = img;
  }
}
