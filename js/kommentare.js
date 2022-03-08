"use strict";

window.addEventListener("load", init);

let song_id = null;

function init() {
    song_id = document.getElementById("song_id");

    loadComments(null, function () {
        let div_kommentar = document.getElementById("div_kommentar");
        showComments(this, div_kommentar, true);
    });
}

function loadComments(k_id, callback) {

    let request = new XMLHttpRequest();
    request.addEventListener("load", callback);
    if (k_id == null) {
        request.open("GET", "../Benutzerverwaltung/kommentare/kommentar_server.php?song_id=" + song_id.value, true);
    } else {
        request.open("GET", "../Benutzerverwaltung/kommentare/kommentar_server.php?song_id=" + song_id.value + "&k_id=" + k_id, true);
    }
    request.responseType = "json";
    request.setRequestHeader("Accept", "application/json");
    request.send();
}

function showComments(request, parent_div, is_first) {

    if (request.status == 200) {

        // parent_div.innerHTML = "";
        let kommentare;

        if (request.responseType == "json") {
            kommentare = request.response;
        } else {
            kommentare = JSON.parse(request.responseText);
        }
        let ans_div;
        // Wenn es keien ans div gibt, dann erstelle eine Sonst lösche Ihre Kinder!
        if (parent_div.getElementsByClassName("answers").length == 0) {
            ans_div = document.createElement("div");
            ans_div.setAttribute("class", "answers");
            parent_div.appendChild(ans_div);
        } else {

            ans_div = parent_div.getElementsByClassName("answers")[0];
            ans_div.innerHTML = "";
        }



        for (let i = 0; i < kommentare.length; i++) {

            let k = document.createElement("div");

            if (!is_first) {

                // k.setAttribute("class", "eingerueckt");
                k.style.marginLeft = "20px";
            }
            let p = document.createElement("p");
            p.innerHTML = "<div class='kommentar_inhalt'>" + kommentare[i].inhalt + "</div>";

            let user_p = document.createElement("p");
            user_p.innerHTML = kommentare[i].username + "<c class='datum'>(" + kommentare[i].datum + ")</c>";

            // let datum_p = document.createElement("p");
            // datum_p.innerHTML = kommentare[i].datum;

            //antworten anzeigen button
            let btn = document.createElement("button");
            btn.innerHTML = "antworten anzeigen";
            btn.addEventListener("click", function () {
                this.style.display = "none";

                loadComments(kommentare[i].PK_Kommentare_ID, function () {
                    showComments(this, k, false);
                });

            });
            btn.setAttribute("class", "kommentare_antwort");

            //antworten schreiben button
            let btn_antwort = document.createElement("button");
            btn_antwort.innerHTML = "antworten schreiben";
            btn_antwort.addEventListener("click", function () {
                let parent = this.parentElement;

                let div_antwort = document.createElement("div");
                parent.insertBefore(div_antwort, this);
                this.style.display = "none";

                let textarea = document.createElement("textarea");

                let btn_antwort_eintragen = document.createElement("button");
                btn_antwort_eintragen.innerHTML = "Posten";
                btn_antwort_eintragen.addEventListener("click", function () {
                    post_comment(kommentare[i].PK_Kommentare_ID, kommentare[i].FK_PK_Song_ID, textarea.value, function () {
                        btn_antwort.style.display = "inline";
                        parent.removeChild(div_antwort);

                        showComments(this, k, false);
                    });

                });

                div_antwort.appendChild(textarea);
                div_antwort.appendChild(btn_antwort_eintragen);




            });
            btn_antwort.setAttribute("class", "kommentare_antwort_schreiben");

            k.appendChild(user_p);
            // k.appendChild(datum_p);

            k.appendChild(p);
            k.appendChild(btn);
            k.appendChild(btn_antwort);
            ans_div.appendChild(k);

        }
    }
}


function post_comment(parent_comment_id, song_id, message, callback) {
    console.log(parent_comment_id, song_id, message);

    let data = "message=" + encodeURIComponent(message) + "&parent_kommentar_id=" + encodeURIComponent(parent_comment_id) + "&song_id=" + encodeURIComponent(song_id);
    console.log(data);


    let request = new XMLHttpRequest();
    request.addEventListener("load", function () {
        if (this.status === 200) {

            console.log(this.responseText);
            loadComments(parent_comment_id, callback);
        } else {
            console.log(this);
        }
    });
    request.open("POST", '../Benutzerverwaltung/kommentare/kommentarschreiben.php', true)
    request.responseType = "text";
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.setRequestHeader("Accept", "text/plain");
    request.send(data);
}