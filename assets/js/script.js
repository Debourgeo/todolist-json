// Here Drag and grop the box (drag les list)






// Here AJAX submission

/*

Prevent submission by button
Submission by ticking the checkbox

Prevent the screen refresh
Update the data 

*/

let checkBoxForm = document.getElementById('checkBoxForm');

// Desactivate the submit button and hiding it.
// The form will be submit by ticking the checkbox
let button = document.getElementById('submit_add_archive');
button.addEventListener("click", e => e.preventDefault());
button.style.display = "none";


document.querySelectorAll(".todo").forEach(checkBoxTodo => {
    checkBoxTodo.addEventListener("click", () => checkBoxForm.submit());
});
// checkBoxForm.addEventListener("submit", e => e.preventDefault());