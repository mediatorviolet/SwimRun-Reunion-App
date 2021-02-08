/**
 * On affiche le bouton que si un champ est modifié
 */

var input = document.getElementsByTagName('input');
var send_modif = document.getElementById('send_modif');
send_modif.style.display = 'none';
for (let i = 0; i < input.length; i++) {
    input[i].addEventListener('change', afficher_btn);
}

function afficher_btn() {
    send_modif.style.display = 'block';
}

/******************************************************/


/**
 * La catégorie de l'équipe change dynamiquement 
 * lorsque l'utilisateur change le genre d'un coureur
 */

var radios_S1 = document.getElementsByName('sexe1');
var radios_S2 = document.getElementsByName('sexe2');
var categorie = document.getElementById('categorie');

function cat() {
    if (radios_S1[0].checked && radios_S2[0].checked) {
        categorie.innerHTML = 'FEMME';
    } else if (radios_S1[1].checked && radios_S2[1].checked) {
        categorie.innerHTML = 'HOMME';
    } else {
        categorie.innerHTML = 'MIXTE';
    }
}
cat();

radios_S1.forEach(radio => {
    radio.addEventListener('change', cat);
});

radios_S2.forEach(radio => {
    radio.addEventListener('change', cat);
});

/******************************************************/


/**
 * Changement dynamique du nom du responsable d'équipe
 */

var nom_respo = document.getElementById('nom1');
var prenom_respo = document.getElementById('prenom1');
var respo_equipe = document.getElementById('respo_equipe');
respo_equipe.innerHTML = nom_respo.value + ' ' + prenom_respo.value;

function respo() {
    respo_equipe.innerHTML = nom_respo.value + ' ' + prenom_respo.value;
}

nom_respo.addEventListener('keyup', respo, false);
prenom_respo.addEventListener('keyup', respo, false);

/******************************************************/


/**
 * On affiche les inputs correspondant en fonction de si l'utilisateur coche 
 * 'FFTri' ou  'NON-LICENCIE'
 */

var radios1 = document.getElementsByName("licence1");
var licence1 = document.getElementById("num_licence1_div");
var certif1 = document.getElementById("certif1_div");

var radios2 = document.getElementsByName("licence2");
var licence2 = document.getElementById("num_licence2_div");
var certif2 = document.getElementById("certif2_div");

function form_controller(radios, licence, certif, user) {
    if (user == 'FFTri') {
        licence.style.display = 'block';
        certif.style.display = 'none';
    } else {
        licence.style.display = 'none';
        certif.style.display = 'block';
    }

    for (let i = 0; i < radios.length; i++) {
        radios[i].onclick = function () {
            var val = this.value;
            if (val == 'FFTri') {
                licence.style.display = 'block';
                certif.style.display = 'none';
            } else {
                licence.style.display = 'none';
                certif.style.display = 'block';
            }
        }
    }
}

/******************************************************/