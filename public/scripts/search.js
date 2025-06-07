const form = document.querySelector('#search-form');
const loadMoreButton = document.querySelector('#load-more');
const eventBox = document.querySelector('#event-list');

let searchStart = 0;
const searchCount = 5;
let lastQuery = '';
let hasMore = false;

form.addEventListener('submit', function (event) {
    event.preventDefault();
    const searchInput = form.searchInput.value.trim();
    if (!searchInput) return;
    lastQuery = searchInput;
    searchStart = 0;
    fetchResults(false);
});

loadMoreButton.addEventListener('click', function (event) {
    event.preventDefault();
    searchStart += searchCount;
    fetchResults(true);
});

function fetchResults(append) {
    fetch(BASE_URL + '/api/searchresults/' + encodeURIComponent(lastQuery) + '?start=' + searchStart + '&count=' + searchCount)
        .then(response => response.ok ? response.json() : Promise.reject())
        .then(json => onJSONResults(json, append))
        .catch(err => console.error('Fetch error:', err));
}

function createCard(item, tipo) {
    const eventEntry = document.createElement('div');
    eventEntry.classList.add('event-entry');

    const eventInfo = document.createElement('div');
    eventInfo.classList.add('event-info');

    const eventDesc = document.createElement('div');
    eventDesc.classList.add('event-desc');

    const eventTitle = document.createElement('strong');
    const eventSubtitle = document.createElement('p');
    const eventDetails = document.createElement('p');
    const dettaglioP = document.createElement('p');
    const eventBuy = document.createElement('a');
    eventBuy.classList.add('event-buy');

    if (tipo === 'artista') {
        eventTitle.textContent = item.Nome;
        eventSubtitle.textContent = item.Categoria + (item.Genere ? " - " + item.Genere : "");
        eventDetails.textContent = item.Hero || '';
        dettaglioP.textContent = 'Profilo';
        eventBuy.href = BASE_URL + '/artist/' + item.ID;
    } else if (tipo === 'evento') {
        eventTitle.textContent = item.Nome;
        eventSubtitle.textContent = item.Nome || '';
        eventDetails.textContent = item.Luogo + " - " + item.DataEvento + " - " + item.Ora;
        dettaglioP.textContent = 'Acquista';
        eventBuy.href = BASE_URL + '/buy/' + item.ID;
    }

    eventDesc.appendChild(eventTitle);
    eventDesc.appendChild(eventSubtitle);
    eventDesc.appendChild(eventDetails);

    const arrowImg = document.createElement('img');
    arrowImg.src = BASE_URL + '/icons/freccia.png';

    eventBuy.appendChild(dettaglioP);
    eventBuy.appendChild(arrowImg);

    eventInfo.appendChild(eventDesc);
    eventInfo.appendChild(eventBuy);

    eventEntry.appendChild(eventInfo);

    eventBox.appendChild(eventEntry);
}

function createResults(json, append = false) {
    if (!append) eventBox.innerHTML = '';

    for (const artista of json.artisti) {
        createCard(artista, 'artista');
    }
    for (const evento of json.eventi) {
        createCard(evento, 'evento');
    }
}

function onJSONResults(json, append) {
    createResults(json, append);

    if (json.hasMoreArtisti || json.hasMoreEventi) {
        loadMoreButton.classList.remove('hide');
        loadMoreButton.classList.add('load-more');
    } else {
        loadMoreButton.classList.add('hide');
        loadMoreButton.classList.remove('load-more');
    }
}

window.addEventListener('DOMContentLoaded', function () {
    const params = new URLSearchParams(window.location.search);
    if (params.has('search')) {
        const value = params.get('search');
        form.searchInput.value = value;
        lastQuery = value;
        searchStart = 0;
        fetchResults(false);
    }
});