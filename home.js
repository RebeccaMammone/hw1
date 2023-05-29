  
  function jsonSpotify(json) {
  
    console.log("JSON RICEVUTO");
    const risultato = document.getElementById('risultato');
    risultato.innerHTML = '';
    document.querySelector("#errore").classList.add("hidden");
    console.log(json);
  
    if (!json.tracks.items.length) {
      document.querySelector("#errore").classList.remove("hidden");
      return;
    }
    
    for (let track in json.tracks.items) {

      const contenitore=document.createElement('div');
      const immagine=document.createElement('img');
      const album=document.createElement('div');
      const artista=document.createElement('div');

      contenitore.dataset.id=json.tracks.items[track].id;
      album.textContent=json.tracks.items[track].name;;
      artista.textContent=json.tracks.items[track].artists[0].name;
      immagine.src=json.tracks.items[track].album.images[0].url;

      contenitore.classList.add('contenitore');
      album.classList.add('album');
      artista.classList.add('artista');
      immagine.classList.add('imgAlbum');

      contenitore.appendChild(immagine);
      contenitore.appendChild(album);
      contenitore.appendChild(artista);
      risultato.appendChild(contenitore);
      
      }
}


function search(event){
  event.preventDefault();

  const form_data = new FormData(document.querySelector("form"));
  fetch("cerca_canzone.php?q="+encodeURIComponent(form_data.get('search'))).then(searchResponse).then(jsonSpotify);
}

function searchResponse(response){
    console.log(response);
    return response.json();
}

document.querySelector("form").addEventListener("submit", search);
