const col1 = document.getElementById("col1");
const col2 = document.getElementById("col2");
const plusButton = document.getElementById("plus");
const form = document.getElementById("form");
let inputCount = 1;

plusButton.addEventListener("click", function () {
    const div = document.createElement("div");
    div.classList.add("mb-3");
    div.classList.add("input-group");
    div.classList.add("input-group-flat");
    
    const input = document.createElement("input");
    input.classList.add("form-control");
    input.setAttribute("type", "text");
    input.setAttribute("autocomplete", "off");
    
    const span = document.createElement("span");
    span.classList.add("input-group-text");
    
    const aHref = document.createElement("a");
    aHref.classList.add("link-secondary");
    aHref.id = "minus";
    aHref.title = "remove";
    aHref.setAttribute("data-bs-toggle", "tooltip");
    
    const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    svg.classList.add("icon");
    svg.setAttribute("width", "24");
    svg.setAttribute("height", "24");
    svg.setAttribute("viewBox", "0 0 24 24");
    svg.setAttribute("stroke-width", "2");
    svg.setAttribute("stroke", "currentColor");
    svg.setAttribute("fill", "none");
    svg.setAttribute("stroke-linecap", "round");
    svg.setAttribute("stroke-linejoin", "round");
    
    const path1 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path1.setAttribute("stroke", "none");
    path1.setAttribute("d", "M0 0h24v24H0z");
    path1.setAttribute("fill", "none");
    
    const path2 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path2.setAttribute("d", "M4 7l16 0");
    
    const path3 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path3.setAttribute("d", "M10 11l0 6");
    
    const path4 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path4.setAttribute("d", "M14 11l0 6");
    
    const path5 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path5.setAttribute("d", "M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12");
    
    const path6 = document.createElementNS("http://www.w3.org/2000/svg", "path");
    path6.setAttribute("d", "M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3");
    
    svg.appendChild(path1);
    svg.appendChild(path2);
    svg.appendChild(path3);
    svg.appendChild(path4);
    svg.appendChild(path5);
    svg.appendChild(path6);
    
    div.appendChild(input);
    div.appendChild(span);
    span.appendChild(aHref);
    aHref.appendChild(svg);
    
    col2.appendChild(div);
    
    // Menambahkan event listener untuk tombol "-"
    aHref.addEventListener("click", function () {
        col2.removeChild(div);
    });
});