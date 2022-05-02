//get the table in the page
const drivingInstructors = document.getElementById("table")


if (drivingInstructors) {
    //click event
    drivingInstructors.addEventListener('click', e => {
        //if click was on a delete button
        if (e.target.className === 'btn btn-danger delete-lesson') {
            //asks user to confirm action
            if (confirm("are you sure you want to delete this lesson")) {
                id = e.target.getAttribute('data-id')

                //delete is actioned
                fetch(`/lesson/delete/${id}`, {
                        method: 'DELETE'
                    })
                    .then(res => window.location.reload())

            }
            alert("Lesson has been deleted");
        }
    })
}