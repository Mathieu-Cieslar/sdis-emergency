import { shallowRef } from 'vue'
import 'leaflet/dist/leaflet.css'
import * as L from 'leaflet'
import img from "../assets/imageFeu.png"
import imgCamion from "../assets/camion.png"
import imgCaserne from "../assets/caserne.png"


export function useLeafletMap() {
    const camionIcon = L.icon({
        iconUrl: imgCamion, // Remplace par le chemin de l'icône de ton camion
        iconSize: [50, 50]
    });

    const feuIcon = L.icon({
        iconUrl: img,


        iconSize:     [50, 50], // size of the icon
        shadowSize:   [50, 64], // size of the shadow
        shadowAnchor: [4, 62],  // the same for the shadow
    });


    const initialMap = shallowRef(null)


    // async function getRoute(start, end) {
    //     try {
    //         const apiKey = '5b3ce3597851110001cf62485485dd442f4f4809a5fea27879963491';
    //         const url = `https://api.openrouteservice.org/v2/directions/driving-car?api_key=${apiKey}&start=${start[1]},${start[0]}&end=${end[1]},${end[0]}`;
    //
    //         const response = await fetch(url);
    //         const data = await response.json();
    //         return data.features[0].geometry.coordinates.map(coord => [coord[1], coord[0]]);
    //     }catch (e){
    //         console.error(e)
    //     }
    // }
    async function animateCamionOnRoute(trajet) {
        // const route = await getRoute(start, end); // Obtiens le trajet

        const camionMarker = L.marker(trajet[0], { icon: camionIcon }).addTo(initialMap.value);
        // Ajoute la Polyline pour visualiser le trajet
        L.polyline(trajet, { color: 'blue', weight: 4 }).addTo(initialMap.value);


        const delay = 1000; // Durée entre chaque étape (ms)

        for (const coord of trajet.reverse()) {
            camionMarker.setLatLng(coord); // Déplace le camion au point courant
            await new Promise(resolve => setTimeout(resolve, delay));
        }

        //  Centrer la carte sur le point final
        initialMap.value.setView(trajet[0], 14);
    }


    // function interpolateCoords(from, to, steps) {
    //     const deltaLat = (to[0] - from[0]) / steps;
    //     const deltaLng = (to[1] - from[1]) / steps;
    //
    //     return Array.from({ length: steps }, (_, i) => [
    //         from[0] + deltaLat * i,
    //         from[1] + deltaLng * i
    //     ]);
    // }
    // const animateCamion = async (start, end) => {
    //     const steps = 100; // Nombre d'étapes de l'animation
    //     const delay = 50;  // Durée entre chaque étape (ms)
    //     const path = interpolateCoords(start, end, steps);
    //
    //     const camionMarker = L.marker(start, { icon: camionIcon }).addTo(initialMap.value);
    //
    //     for (const coord of path) {
    //         camionMarker.setLatLng(coord); // Déplace le camion
    //         await new Promise(resolve => setTimeout(resolve, delay)); // Pause entre chaque étape
    //     }
    //
    //     // Optionnel : Centrer la carte sur le feu une fois arrivé
    //     initialMap.value.setView(end, 14);
    // };
    const initialiseMap = () => {
        if (!initialMap.value) {
            // On initialise la carte
            initialMap.value = new L.Map('mapBaseStation').setView([45.75, 4.85], 11)
            // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
            const tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                // Il est toujours bien de laisser le lien vers la source des données
                attribution:
                    'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                minZoom: 1,
                maxZoom: 20
            })
            initialMap.value.addLayer(tileLayer)
        }
    }


    const getFeuFromApi = async () => {
 const response = await fetch('http://localhost:8081/api/feu',{method:'GET' })
         const data = await response.json();
        console.log(data)
        return data
    }
        const getcaserneFromApi = async () => {
 const response = await fetch('http://localhost:8081/api/caserne',{method:'GET' })
         const data = await response.json();
        console.log(data)
        return data
    }
    const getInterFromApi = async () => {
 const response = await fetch('http://localhost:8081/api/intervention',{method:'GET' })
         const data = await response.json();
        console.log(data)
        return data
    }


    const putCaserneOnMap = async () => {
        const caserneIcon = L.icon({
            iconUrl: imgCaserne,
            iconSize: [50, 50], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            shadowAnchor: [4, 62], // the same for the shadow
        });

        const data = await getcaserneFromApi();
        console.log(data);
        data.forEach(caserne => {
            const marker = L.marker([caserne.coorX, caserne.coorY], { icon: caserneIcon }).addTo(initialMap.value);

            // Crée un contenu pour le pop-up (vous pouvez personnaliser cela selon vos besoins)
            const popupContent = `
            <div>
                <h4>Caserne: ${caserne.nom}</h4>
                <h4>Coor X: ${caserne.coorX} Coor Y: ${caserne.coorY}</h4>
            </div>
        `;

            // Attache le pop-up au marqueur et l'affiche lorsqu'on clique dessus
            marker.bindPopup(popupContent);
        });
    };

    const putFeuOnMap = async () => {

        const data = await getFeuFromApi()
        console.log(data)
        data.forEach(feu => {
            L.marker([feu.coorX, feu.coorY], {icon : feuIcon} ).addTo(initialMap.value)

            // Simuler une position de départ pour le camion
            // const startPosition = [45.84555588,4.830057141]; // Position de départ fictive
            // animateCamionOnRoute(startPosition, [feu.coorX, feu.coorY]); // Anime le camion vers le feu
    })
    }
    const doInter = async () => {

        const data = await getInterFromApi()
        console.log(data)
        data.forEach(inter => {
             animateCamionOnRoute(inter.trajet); // Anime le camion vers le feu
        })
    }

    const eventSource = new EventSource('http://localhost:3000/.well-known/mercure?topic=https://example.com/new-fire');
    const eventSourceInter = new EventSource('http://localhost:3000/.well-known/mercure?topic=https://example.com/new-inter');

    eventSource.onmessage = (event) => {
        const data = JSON.parse(event.data);
        console.log('Nouvel événement Mercure reçu :', data);

        // Ajouter un marqueur sur la carte avec les coordonnées reçues
        L.marker([data.coorX, data.coorY], { icon: feuIcon }).addTo(initialMap.value);

        // // Simuler l'animation du camion vers ce nouveau feu
        // const startPosition = [45.7840361, 4.821052778];
        // animateCamionOnRoute(startPosition, [data.coorX, data.coorY]);
    };


    eventSourceInter.onmessage = (event) => {
        const data = JSON.parse(event.data);
        console.log('Nouvel événement Mercure reçu :', data);
        animateCamionOnRoute(data.trajet);
    };

    return {
        initialMap,
        initialiseMap,
        putFeuOnMap,
        putCaserneOnMap,
        doInter

    }
}
