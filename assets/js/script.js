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



const ticking = async () => {
    try {
        const Data = new FormData(checkBoxForm);
        let sendRequest = await fetch("assets/php/Form_task_to_archive.php", {
            method: "POST",
            body: Data
        });
        let answer = await sendRequest.text();
        console.log(answer);

    } catch (error) {
        console.error(error);
    }
}


document.querySelectorAll(".todo").forEach(checkBoxTodo => {
    checkBoxTodo.addEventListener("click", () => ticking());
});