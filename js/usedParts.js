

function submitAll()
{
    if(confirm("You are about to submit all changes on this page"))
    {
        const submitButtons = document.getElementsByName("submit_mod");
        for(let i =0; i < submitButtons.length; ++i)
        {
            submitButtons[i].click();
        }
    }
}



const locationBoxes = document.getElementsByName("location_mod");
for(let i =0; i < locationBoxes.length; ++i)
{
    autocomplete(locationBoxes[i], locations);
}

function SubForm(e){
    // let e = document.getElementById(id)
    // e.preventDefault();
    let url = 'actions/consumePart.php';
    // e.form.submit();
    console.log(e.form);
    let data = $(e.form).serializeArray();
    if(document.getElementById("person").value === "")
    {
        alert("Please Enter Your Name");
        return;
    }
    data.push({"name" : "person", "value" : document.getElementById("person").value})
    console.log(data);
    $.ajax({
        url: url,
        type: 'post',
        data: data,
        success: function (e){
            console.log(e);
            alert("Row Updated");
        }

    })

}