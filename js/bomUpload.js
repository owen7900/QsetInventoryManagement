class PO{
    constructor(po_number, parts_list, source, date, owner) {
        this.po_number = po_number;
        this.parts_list = parts_list;
        this.source = source;
        this.date = date;
        this.owner = owner;
    }
}

class PartInfo {
     constructor(part_no, price_per_unit,number_purchased, location, project_no, description) {
         this.part_no = part_no;
         this.price_per_unit = price_per_unit;
         this.number_purchased = number_purchased;
         this.location = location;
         this.project_no = project_no;
         this.description = description;
     }
}


function processFile(contents) {
    console.log(contents);
    let allLines  = contents.split(/\r\n|\n/);
    let headers = allLines[0].split(',');

    let type = "DIGIKEY";

    switch (type)
    {
        case "DIGIKEY":
            this.po = processDigikey(allLines);
            break;
        case "MACMASTER_CARR":

            break;
        default:
            console.log("unable to identify supplier");
            break;
    }
    showForm();
}

function showForm()
{
    const po = this.po;
    document.getElementById("po_number").value = po.po_number;
    document.getElementById("source").value = po.source;
    document.getElementById("date").value = po.date;
    document.getElementById("owner").value = po.owner;
    let table = document.getElementById("output_table");
    if(!this.firstRow && table.getElementsByTagName('tr').length > 1)
    {
        table.deleteRow(1);
    }
    this.firstRow = false;
    this.count = 0;
    for (let i = 0; i < po.parts_list.length; ++i) {
        let row  = table.insertRow(i + 1);
        let part = po.parts_list[i];
        row.insertCell(0).innerHTML = '<div class="autocomplete"><input type="text" name="part_no' + this.count + '" id="part_no' + this.count + '" value="'+part.part_no+'"></div>';
        row.insertCell(1).innerHTML = '<div class="autocomplete"><input type="number" step="0.01" name="price' + this.count + '" id="price' + this.count + '" value="'+part.price_per_unit+'"></div>';
        row.insertCell(2).innerHTML = '<div class="autocomplete"><input type="number" name="number_purchased' + this.count + '" id="number_purchased' + this.count + '" value="'+part.number_purchased+'"></div>';
        row.insertCell(3).innerHTML = '<div class="autocomplete"><input type="text" class="location" name="location' + this.count + '" id="location' + this.count +'" value="'+part.location+'"></div>';
        row.insertCell(4).innerHTML = '<div class="autocomplete"><input type="text" class="project_no" name="project_no' + this.count + '" id="project_no' + this.count +'" value="'+part.project_no+'"></div>';
        row.insertCell(5).innerHTML = '<div class="autocomplete"><input type="text" name="description' + this.count  + '" id="description' + this.count +'" value="'+part.description+'"></div>';
        row.insertCell(6).innerHTML = '<button type="button" id="delete' + this.count + '" class="btn" onclick="deleteRow(' + (this.count) +')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">\n' +
            '  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>\n' +
            '  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>\n' +
            '</svg></button>';
        autocomplete(document.getElementById("location"+this.count), locations);
        autocomplete(document.getElementById("project_no"+this.count), project_nos);
        this.count++;
    }
    document.getElementById("count").value = this.count;
    update();
}

function deleteRow(i)
{
    const index = document.getElementById('delete'+i).parentNode.parentNode.rowIndex;
    document.getElementById("output_table").deleteRow(index);
}

function processDigikey(data){
    let part_list = [];
    for (let i = 1; i < data.length; i++) {
        let rowDat = data[i].split(",");
        if(rowDat[0].length < 3)
        {
            break;
        }
        let pi = new PartInfo(rowDat[2].slice(1,-1), rowDat[7].slice(1,-1), rowDat[1].slice(1,-1), "", "", rowDat[4].slice(1,-1));
        console.log(pi);
        part_list.push(pi);
    }
    let today = new Date();
    let dd = String(today.getDate()).padStart(2, '0');
    let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    let yyyy = today.getFullYear();
    return new PO(document.getElementById("fileLabel").textContent, part_list, "DIGIKEY", mm + "-" + dd + "-" + yyyy, "");
}

function updateFileName(e) {
    let label = document.getElementById("fileLabel");
    label.textContent = e.target.files[0].name;
    this.filename = e.target.files[0].name;
    let file = e.target.files[0];
    if (!file) {
        return;
    }
    let reader = new FileReader();
    reader.onload = function(e) {
        let contents = e.target.result;
        processFile(contents);
    };
    reader.readAsText(file);
}

function update(e){
    let table = document.getElementById("output_table");
    let rows = table.getElementsByTagName('tr');
    let lastRow = rows[rows.length - 1];
    if(lastRow.cells[0].firstChild.firstChild.value !== "")
    {
        insertRow();
    }
}


function insertRow()
{
    let table = document.getElementById("output_table");
    let row  = table.insertRow();
    row.insertCell(0).innerHTML = '<div class="autocomplete"><input type="text" name="part_no' + this.count + '" id="part_no' + this.count + '"></div>';
    row.insertCell(1).innerHTML = '<div class="autocomplete"><input type="number" step="0.01" name="price' + this.count + '" id="price' +this.count + '"></div>';
    row.insertCell(2).innerHTML = '<div class="autocomplete"><input type="number" name="number_purchased' + this.count + '" id="number_purchased' + this.count + '"></div>';
    row.insertCell(3).innerHTML = '<div class="autocomplete"><input type="text" class="location" name="location' + this.count + '" id="location' + this.count +'"></div>';
    row.insertCell(4).innerHTML = '<div class="autocomplete"><input type="text" class="project_no" name="project_no' + this.count + '" id="project_no' + this.count +'"></div>';
    row.insertCell(5).innerHTML = '<div class="autocomplete"><input type="text" name="description' + this.count  + '" id="description' + this.count +'"></div>';
    row.insertCell(6).innerHTML = '<button type="button" class="btn" id="delete' + this.count + '" onclick="deleteRow(' + (this.count) +')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">\n' +
        '  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>\n' +
        '  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>\n' +
        '</svg></button>';
    autocomplete(document.getElementById("location"+this.count), locations);
    autocomplete(document.getElementById("project_no"+this.count), project_nos);
    this.count++;
    document.getElementById("count").value = this.count;
}
this.firstRow = true;
this.filename = '';
function insertFirstRow()
{
    if(this.firstRow)
    {
        this.firstRow = false;
        insertRow();
    }
}

function submitOrError()
{
    let submit = true;
    let tablelements = document.getElementById("input_form").elements;
    console.log(tablelements);
    for (let i = 0; i < (this.count - 1)* 7 + 5; i++) {
        console.log(tablelements[i]);
        if(tablelements[i].tagName === "BUTTON")
        {
            continue;
        }
        if(tablelements[i].value === "")
        {
            console.log("false");
            alert("Please fill in all fields, missing: " + tablelements[i].id )
            submit = false;
            break;
        }
    }


    if(submit){
        document.getElementById("input_form").submit();
    }
}

function autofillLocation(e)
{
    let locationBoxes = document.getElementsByClassName("location");
    for (let i = 0; i < locationBoxes.length; i++)
    {
        locationBoxes[i].value = e.value;
    }
}

function autofillProjectNumber(e)
{
    let locationBoxes = document.getElementsByClassName("project_no");
    for (let i = 0; i < locationBoxes.length; i++)
    {
        locationBoxes[i].value = e.value;
    }
}
autocomplete(document.getElementById("owner"), owners);
document.getElementById("inputFile").addEventListener('change', updateFileName, false);
document.getElementById("input_form").addEventListener('input', update, false);
this.count = 0;
