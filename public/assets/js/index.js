const complete = document.querySelectorAll(".fa-check")
const text = document.querySelectorAll(".todo-text")
const todos = document.querySelectorAll(".todo")
const todos_date = document.querySelectorAll(".todo-date")


complete.forEach((com,id)=>{

    com.addEventListener("click",()=>{

        text[id].classList.toggle("completed")
        todos_date[id].classList.toggle("completed")
        todos[id].classList.toggle("todo-completed")

    })
})
