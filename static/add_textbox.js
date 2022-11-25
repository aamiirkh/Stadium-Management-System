const count = document.getElementById('.')

function textBoxes(count) {
    div = document.createElement("div");
    for (i = 0; i < count; i++) {
        a = document.createElement("input")
        a.setAttribute('type', 'text')
        a.setAttribute('class', 'row')
        div.append(a);
    }
}

textBoxes(count); 