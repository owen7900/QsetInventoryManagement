function deleteRow(e) {
    let part_number = e.parentNode.parentNode.cells[0].innerText;
    let quantity = e.parentNode.parentNode.cells[1].innerText;
    let location = e.parentNode.parentNode.cells[2].innerText;
    let owner = e.parentNode.parentNode.cells[3].innerText;
    let project_no = e.parentNode.parentNode.cells[4].innerText;
    let description = e.parentNode.parentNode.cells[5].innerText;
    if(document.getElementById("person").value === "")
    {
        alert("Please Enter Your Name");
        return;
    }
    let data = {
        "part_number": part_number,
        "quantity": quantity,
        "location": location,
        "owner": owner,
        "project_no": project_no,
        "description": description,
        "person" : document.getElementById("person").value
    };
    let url = "actions/deletePart.php";
    let rowI = e.parentNode.parentNode.rowIndex;
    document.getElementById("table").deleteRow(rowI);
    $.ajax({
        url: url,
        type: 'post',
        data: data,
        success: function (e) {
            console.log(e);
        }
    });
}

function moveRowToGeneral(e) {
    let part_number = e.parentNode.parentNode.cells[0].innerText;
    let quantity = e.parentNode.parentNode.cells[1].innerText;
    let location = e.parentNode.parentNode.cells[2].innerText;
    let owner = e.parentNode.parentNode.cells[3].innerText;
    let project_no = e.parentNode.parentNode.cells[4].innerText;
    let description = e.parentNode.parentNode.cells[5].innerText;
    if(document.getElementById("person").value === "")
    {
        alert("Please Enter Your Name");
        return;
    }
    let data = {
        "part_number": part_number,
        "quantity": parseInt(quantity),
        "location": location,
        "owner": owner,
        "project_no": project_no,
        "description": description,
        "to_project" : "GENERAL",
        "person" : document.getElementById("person").value
    };
    let url = "actions/movePart.php";
    $.ajax({
        url: url,
        type: 'post',
        data: data,
        success: function (e) {
            console.log(e);
        }
    });
    let rowI = e.parentNode.parentNode.rowIndex;
    document.getElementById("table").deleteRow(rowI);
}

function deleteAll(e) {
    deleteButtons = document.getElementsByName("delete");
    console.log(deleteButtons.length);
    for (let i = 0; i < deleteButtons.length; i++)
    {
        deleteRow(deleteButtons[i]);
    }
}