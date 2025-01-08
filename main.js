let services = []

async function ping(url) {
    return fetch(url, { mode: "no-cors" });
}

async function serverAlive(url) {
    return new Promise((resolve, reject) => {
        ping(url)
            .then((response) => {
                if (response.status >= 400 && response.status < 600)
                    reject(`Error ${response.status}`)
                resolve(response);
            })
            .catch((error) => {reject(error)})
    });
    
}

function initServices() {
    target = document.getElementById("target");
    config.forEach(item => {
        const li = document.createElement("li");
        const img = document.createElement("img");
        const a = document.createElement("a");
        const label = document.createTextNode("");

        label.nodeValue = item.label;
        img.src = item.icon;
        a.href = item.link;

        a.appendChild(img);
        a.appendChild(label);
        li.appendChild(a);
        target.appendChild(li);

        services.push({
            "host" : item.link,
            "target" : a,
        })
    });
}

function setStatus(status, target) {
    target.className = status;
}

async function initStatus () {
    updateStatus();
}

async function updateStatus() {
    services.forEach(item => {
        const target = item.target
        serverAlive(item.host)
            .then( _response => { setStatus("live", target) })
            .catch( _error => { setStatus("down", target) });
    }, this)
}


// MAIN

initServices()
initStatus()

setInterval(updateStatus, 10000)