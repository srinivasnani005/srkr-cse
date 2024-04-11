document.querySelector('.signin').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default link behavior
    document.querySelector('.form-container').style.display = 'block';
    document.querySelector('.background-content').style.display = 'none';
});

var dragItem = document.querySelector("#item");
var container = document.querySelector("#container");
var studentForm = document.getElementById("studentLogin");
var teacherForm = document.getElementById("teacherLogin");

var isDragging = false;
var initialX = 0;
var xOffset = 0;
var minOffset = 0;
var maxOffset = 150;

container.addEventListener("mousedown", dragStart, false);
container.addEventListener("mousemove", drag, false);
container.addEventListener("mouseup", dragEnd, false);
container.addEventListener("mouseleave", dragEnd, false);
container.addEventListener("click", toggleFormsOnClick, false);

container.addEventListener("touchstart", dragStart, false);
container.addEventListener("touchmove", drag, false);
container.addEventListener("touchend", dragEnd, false);

function dragStart(e) {
    e.preventDefault();
    if (e.type === "touchstart") {
        initialX = e.touches[0].clientX - xOffset;
    } else {
        initialX = e.clientX - xOffset;
    }
    isDragging = true;
}

function drag(e) {
    if (isDragging) {
        var x;
        if (e.type === "touchmove") {
            x = e.touches[0].clientX - initialX;
        } else {
            x = e.clientX - initialX;
        }
        xOffset = Math.min(Math.max(x, minOffset), maxOffset);
        setTranslate(xOffset);
    }
}

function dragEnd(e) {
    isDragging = false;
    if (xOffset > (maxOffset - minOffset) / 2) {
        xOffset = maxOffset;
        toggleForms("teacher");
    } else {
        xOffset = minOffset;
        toggleForms("student");
    }
    setTranslate(xOffset);
}

function setTranslate(x) {
    dragItem.style.transform = "translate3d(" + x + "px, 0, 0)";
}

function toggleForms(type) {
    if (type === "teacher") {
        studentForm.style.display = "none";
        teacherForm.style.display = "block";
    } else {
        studentForm.style.display = "block";
        teacherForm.style.display = "none";
    }
}

function toggleFormsOnClick(e) {
    if (e.clientX - container.getBoundingClientRect().left > maxOffset / 2) {
        xOffset = maxOffset;
        toggleForms("teacher");
    } else {
        xOffset = minOffset;
        toggleForms("student");
    }
    setTranslate(xOffset);
}


