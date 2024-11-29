import { shallowRef } from 'vue'
import 'leaflet/dist/leaflet.css'
import * as L from 'leaflet'

export function useLeafletMap() {
    const initialMap = shallowRef(null)

    const initialiseMap = () => {
        if (!initialMap.value) {
            // On initialise la carte
            initialMap.value = new L.Map('mapBaseStation').setView([46.8, 2], 6)
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

    return {
        initialMap,
        initialiseMap
    }
}
