let services = {}

async function getStatus() {
    return fetch("get_status.php")
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

        services[item.label] = a;
    });
}

function setStatus(status, target) {
    target.className = status;
}

async function initStatus () {
    updateStatus();
}

async function updateStatus() {
    getStatus().then((response => {
        response.json().then( result => {
            service_status = result;
            console.log(service_status);
            for (const label in service_status) {
                const status = service_status[label] ? "live" : "down";
                setStatus(status, services[label]);
            }
        })
    }))
}


// MAIN

initServices()
initStatus()

setInterval(updateStatus, 30000)