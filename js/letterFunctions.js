var vowels = "aeiouáéíóúôäyý";
var shortVowels = "aeiouôä";
var longVowels = "áéíóúý";
var consonants = "qwrtzpsdfghjklxcvbnméŕťšďĺľčňž";

function syllable(text) {
    if (text != ""){
        var textArray = clearRedundantSymbols(text).split(' ') ;
    }
    else return 0;


    var countOfSyllable = 0;

    for (let i = 0; i < textArray.length; i++){
        var word = textArray[i].toLowerCase().split('');

        if (word[0] === "-"){
            continue;
        }

        for (let j = 0; j < word.length ; j++) {
            if (word[j] === "i"){
                var letter = word[j +1] ;
                if (letter === "a" || letter === "e" || letter === "u" ){

                    word.splice(j,1);
                }
            }
            if (word[j] === "o"){
                var letter = word[j +1] ;
                if (letter === "u"){
                    word.splice(j,1);
                }
            }
            else if (word[j] + word[j + 1] === "ch"){
                word.splice(j,1);
            }

        }

        if (word.length === 0){

        }

        else if (word.length <= 2) {
            countOfSyllable++;
            // a || ne
        }

        else if (word.length === 3) {
            if (oneOf(word[0], vowels) && !oneOf(word[1],vowels) && oneOf(word[2], vowels)) {
                countOfSyllable += 2;
                // ano = a-no / a-le
            } else {
                countOfSyllable++;
                // srb / raz / zlé
            }
        }

        else if (word.length === 4) {
            if (oneOf(word[word.length - 1], consonants) && oneOf(word[word.length - 2], consonants)) {
                countOfSyllable++;
                //srsť
            }
            else if (oneOf(word[0], longVowels)) {
                countOfSyllable += 2;
            }
            else if (oneOf(word[0], shortVowels) && oneOf(word[1], consonants) && oneOf(word[2], consonants) || oneOf(word[0], vowels) && oneOf(word[1], consonants) && oneOf(word[2], consonants)) {
                countOfSyllable += 2;
                // alej = a-lej / ovca = ov-ca
            }
            else if (oneOf(word[0],consonants) && oneOf(word[1],consonants) && oneOf(word[2],consonants) && oneOf(word[3],vowels)) {
                countOfSyllable += 2;
                // prdy = pr-dy
            }
            else if (oneOf(word[0],consonants) && oneOf(word[1],consonants) && oneOf(word[3],consonants)){
                countOfSyllable++;
                // stáť
            }
            else if(allAre(word,consonants)){
                countOfSyllable++;
            }
            else {
                countOfSyllable += 2;
            }
        }

        else if (word.length === 5){
            if (oneOf(word[0],consonants) && oneOf(word[1],consonants) && oneOf(word[2],consonants) && oneOf(word[3],consonants) && oneOf(word[4],vowels) ){
                countOfSyllable += 2;
                // srste = srs-te
            }
            else if (oneOf(word[0],consonants) && oneOf(word[1],vowels) && oneOf(word[2],consonants) && oneOf(word[3],vowels) && oneOf(word[4],consonants)){
                countOfSyllable += 2;
                // vyryť = vy-ryť
            }
            else if (oneOf(word[0],consonants) && oneOf(word[1],vowels) && oneOf(word[2],consonants) && oneOf(word[3],consonants) && oneOf(word[4],vowels)){
                countOfSyllable += 2;
                // pusto = pu-sto
            }
            else if (oneOf(word[0],vowels) && oneOf(word[1],consonants) && oneOf(word[2],vowels) && oneOf(word[3],consonants) && oneOf(word[4],consonants)){
                countOfSyllable += 2;
                // Alojz = A-lojz
            }

            else if (oneOf(word[0],vowels) && oneOf(word[1],consonants) && oneOf(word[2],consonants) ){
                countOfSyllable += 2;
                // ostať = o-stať
            }
            else if (oneOf(word[0],vowels) && oneOf(word[1],consonants) && oneOf(word[2],vowels) ){
                countOfSyllable += 3;
                // oželie = o-že-lie
            }
            else if (oneOf(word[0],consonants) && oneOf(word[1],vowels) && oneOf(word[2],consonants) && oneOf(word[3],vowels) && oneOf(word[4],vowels)){
                countOfSyllable += 3;
                // nivea = ni-ve-a
            }
            else if (oneOf(word[0],consonants) && oneOf(word[1],consonants) && oneOf(word[2],vowels) && oneOf(word[3],consonants) && oneOf(word[4],vowels) ){
                countOfSyllable += 2;
                // ktorá = kto-rá
            }
            else if (oneOf(word[0],consonants) && oneOf(word[1],consonants) && oneOf(word[2],consonants) && oneOf(word[3],shortVowels) && oneOf(word[4],consonants) ){
                countOfSyllable++;
                // svrab
            }
            else if (oneOf(word[0],consonants) && oneOf(word[1],consonants) && oneOf(word[2],consonants) && oneOf(word[3],longVowels) && oneOf(word[4],consonants) ){
                countOfSyllable +=2;
                // blšák = bl-šák
            }


        }

        else{
            for (let j = 0; j < word.length; j++) {
                try{
                    if (oneOf(word[j],consonants) && oneOf(word[j + 1],vowels) && oneOf(word[j+2],consonants ) && !oneOf(word[j+3],consonants)){
                        countOfSyllable++;
                        j++;
                        // zabava = zá-ba-va
                        //console.log("1");

                    }
                    if ( j === 0 && oneOf(word[j],vowels) && oneOf(word[j+1],consonants) && oneOf(word[j+2],vowels)){
                        countOfSyllable++;
                        // anál = a-nál ------
                        //console.log("2");
                    }
                    else if (oneOf(word[j],consonants) && oneOf(word[j + 1],vowels) && oneOf(word[j+2],consonants ) && !oneOf(word[j+3],consonants)){
                        countOfSyllable++;
                        j++;
                        // zabava = zá-ba-va
                        //console.log("3");
                    }
                    else if (oneOf(word[j],consonants) && oneOf(word[j + 1],vowels) && word[j + 1] === word[word.length]){
                        countOfSyllable++;
                        j++;
                        // zabava = zá-ba-va
                        //console.log("4");

                    }
                    else if ( j === 0 && oneOf(word[j],vowels) && oneOf(word[j+1],consonants) && oneOf(word[j+2],consonants)){
                        countOfSyllable++;
                        j++; // couse for increase one
                        // alzák = al-zák
                        //console.log("5");
                    }
                    else if (oneOf(word[j],consonants) && oneOf(word[j + 1],consonants) && oneOf(word[j + 2],vowels) && oneOf(word[j + 3],consonants)){
                        countOfSyllable++;
                        j += 2; // couse for increase one
                        // dlane = dla-ne
                        //console.log("6");
                    }
                    else if (oneOf(word[j],consonants) && oneOf(word[j+1],consonants) && oneOf(word[j+2],consonants) && oneOf(word[j+3],shortVowels) ){
                        countOfSyllable++;
                        j += 3; // couse for increase one
                        // svrbydlo = svr-by-dlo
                        //console.log("7");
                    }
                    else if (oneOf(word[j],consonants) && oneOf(word[j+1],vowels) && oneOf(word[j + 2],consonants) && word[j+2] === word[word.length - 1]){
                        j += 2; // couse for increase one
                        countOfSyllable++;
                        // paralel = pa-ra-lel
                        //console.log("8");
                    }
                    else if (oneOf(word[j],consonants) && oneOf(word[j+1],vowels) && oneOf(word[j + 2],vowels)){
                        j += 2; // couse for increase one
                        countOfSyllable += 2;
                        // poobede = po-o-be-de
                        //console.log("9");
                    }
                    else if (oneOf(word[j],consonants) && oneOf(word[j+1],consonants) && oneOf(word[j+2],consonants) && oneOf(word[j + 3],vowels) && oneOf(word[j + 4],consonants) && oneOf(word[j + 5],consonants)){
                        j += 3; // couse for increase one
                        countOfSyllable++;
                        // spresniť = spre-sniť
                        //console.log("10");
                    }
                    else if (oneOf(word[j],consonants) && oneOf(word[j+1],consonants) && oneOf(word[j+2],consonants) && oneOf(word[j + 3],vowels) && oneOf(word[j + 4],consonants) && !oneOf(word[j + 5],consonants)){
                        j += 3; // couse for increase one
                        countOfSyllable++;
                        // spraviť = spra-viť
                        //console.log("11");
                    }
                    else if (oneOf(word[j],consonants) && oneOf(word[j+1],consonants) && oneOf(word[j+2],consonants) && oneOf(word[j + 3],longVowels)){
                        j += 2; // couse for increase one
                        countOfSyllable++;
                        // blšáky = bl-šáky
                        //console.log("12");
                    }
                    else if (oneOf(word[j],consonants) && oneOf(word[j+1],vowels) && oneOf(word[j + 2],consonants) && oneOf(word[j + 3],consonants) && word[j + 3] === word[word.length -1] ){
                        countOfSyllable++;
                        j += 3; // couse for increase one
                        // osemnásť = o-sem-násť (násť)
                        //console.log("13");
                    }
                    else if (oneOf(word[j],consonants) && oneOf(word[j+1],vowels) && oneOf(word[j + 2],consonants) && oneOf(word[j + 3],consonants) ){
                        countOfSyllable++;
                        j += 2; // couse for increase one
                        // osemnásť = o-sem-násť
                        //console.log("14");
                    }
                    else if (oneOf(word[j],consonants) && oneOf(word[j+1],consonants) && oneOf(word[j+2],vowels) && oneOf(word[j+3],vowels) && word[j+3] === word[word.length - 1] ){
                        countOfSyllable++;
                        j += 3;
                        //console.log("15");
                    }
                    else if ( oneOf(word[j],consonants) && oneOf(word[j+1],consonants) && oneOf(word[j+2],consonants) && oneOf(word[j+3],consonants)){
                        countOfSyllable++;
                        j += 2;
                        // brnkadlo = brn-ka-dlo
                        //console.log("16");
                    }
                    else if (oneOf(word[j],consonants) && oneOf(word[j+1],vowels) && word[j+1] === word[word.length - 1]){
                        countOfSyllable++;
                        j++;
                        //console.log("17");
                        // špinavý = špi-na-vý = brn-ka-dlo
                    }
                    else if (oneOf(word[j],consonants) && oneOf(word[j+1],vowels) && oneOf(word[j+2],consonants) && oneOf(word[j+3],consonants) && oneOf(word[j+4],consonants)){
                        countOfSyllable++;
                        j +=2;
                        //console.log("18");
                        // extravagantné = ex-tra-va-gan-tné
                    }


                }catch (e) {
                    console.log(e);
                }

            }
        }

    }

    return countOfSyllable;
}

// Find out if your letter is in that group
function oneOf(letter,letterClass) {
    var statement = false;
    for (let i = 0; i < letterClass.length; i++) {
        if (letter === letterClass[i]){
            statement = true;
        }
    }

    return statement;
}

function allAre(letters,letterClass) {
    var statement = [];
    for (let i = 0; i < letters.length; i++) {
        for (let j = 0; j < letterClass.length; j++) {
            if (letters[i] === letterClass[j]){
                statement.push(true);
            }
        }
    }

    if(statement.length === letters.length){
        return true;
    }
    else{
        return false;
    }
}

function clearRedundantSymbols(result) {
    result = result.toString();
    try{
        result = result.replaceAll(".",''); //remove .
        result = result.replaceAll("?", ''); //remove ?
        result = result.replaceAll(";", ''); //remove ;
        result = result.replaceAll("%", ''); //remove %
        result = result.replaceAll("°", ''); //remove °
        result = result.replaceAll("\\", ''); //remove \
        result = result.replaceAll("\/", ''); //remove /
        result = result.replaceAll(/,/g, ''); // remove ,
    }catch (e) {
        console.log(e)
    }

    return result;
}

function countOfLetters(text) {
    if (text != ""){
        text = clearRedundantSymbols(text);
    }
    else return 0;


    var length = 0;
    for (let i = 0; i < text.length; i++) {
        if (!(text[i] === ' ')){
            length++;
        }
    }

    return length;
}

function copy() {
    var text = "";
    for (let i = 0;i < inputs.length; i++){
        if (inputs[i].value.trim() != ""){
            text += inputs[i].value + "\n" ;
        }

    }
    navigator.clipboard.writeText(text);
}

function deleteAllPoet() {
    var text = "";
    for (let i = 0;i < inputs.length; i++){
        inputs[i].value = "";

    }
}

// I would like to number increment done by your self !!!

// where is cursor function

