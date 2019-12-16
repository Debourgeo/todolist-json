// Here Drag and grop the box (drag les list)






// Here AJAX submission

/*

Prevent submission by button                         ok
Submission by ticking the checkbox          to do

Prevent the screen refresh
Update the data 

*/

const checkBoxForm = document.getElementById('checkBoxForm');

// Desactivate the submit button and hiding it.
// The form will be submit by ticking the checkbox
const button = document.getElementById('submit_add_archive');
button.addEventListener("click", e => e.preventDefault());
button.style.display = "none";











const movingByTick = () => {
    console.log(checkBoxForm[0].parentNode);

}
movingByTick();





/// ***********************************************************************************
/// ***********************************************************************************
/// ***********************************************************************************
/// ***********************************************************************************

const ticking = () => {
    // checkBoxForm.submit();
    try {
        const data = new FormData(checkBoxForm);
        fetch("assets/php/Form_task_to_archive.php", {
            method: "POST",
            body: data
        });
    } catch (error) {
        console.error(error);
    }
}

const reorganization = (list) => {
    let theClass;
    if (list == "todo") {
        theClass = "todo";
        idForm = "#checkBoxForm";
    } else {
        theClass = "done";
        idForm = "#doneForm";
    }
    target = document.querySelectorAll(`${idForm} ul li input`);
    target.forEach((input, i) => {
        input.name = `${i}`;
        input.id = `${theClass}${i}`;
        input.class = `${theClass}`;
    })
}

document.querySelectorAll(".todo").forEach(checkBoxTodo => {
    checkBoxTodo.addEventListener("click", () => {
        // Sending form
        ticking();
        // Moving the node
        const toMove = checkBoxTodo.parentNode;
        let target = document.querySelector('#doneForm ul li');
        target.parentNode.insertBefore(toMove, target);
        // Reorganization !
        reorganization("todo");
        reorganization("done");

    });
});