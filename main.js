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
    return updateStatus();
}

async function updateStatus() {
    getStatus().then((response => {
        response.json().then( result => {
            service_status = result;
            for (const label in service_status) {
                const status = service_status[label] ? "live" : "down";
                setStatus(status, services[label]);
            }
        })
    }))
}



async function all_images_loaded() {
    return new Promise((resolve, reject) => {
        setTimeout(
            () => {
                images = document.querySelectorAll("img");
                let all_complete = Array.from(images).every((img) => img.complete)
                if (all_complete) {
                    resolve('images load finish');
                }
                else {
                    reject('image loading');
                }
            },
            Math.random() + 10 // necessary to make each Promise a new instance 
        )
    })
}

async function wait_for_all_images_loaded(callback){
    all_images_loaded()
        .then( (_res) => { callback() })
        .catch((_err) => { wait_for_all_images_loaded(callback) } )
}



document.addEventListener('DOMContentLoaded', function () {
    initServices()
    wait_for_all_images_loaded(() => {
        initStatus();
        setInterval(updateStatus, 30000);
    })
    

});

