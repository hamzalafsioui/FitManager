console.log(document.getElementById("course-form"));
console.log("courses.js loaded");

// add course
document
  .getElementById("course-form")
  .addEventListener("submit", async function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    // log(formData);
    try {
      let response = await fetch("../includes/add_course.php", {
        method: "POST",
        body: formData,
      });
    //   console.log(response);
    //   console.log(response.body);
      

      let result = await response.json();
      console.log(result);

      if (result.status === "success") {
        
        showMessage("Course added successfully!", "green");


        addCourseToTable(result.course);

        this.reset();
      } else {
        showMessage("Error adding course.", "red");
      }
    } catch (err) {
      showMessage("Server error.", "red");
    }
  });

function showMessage(text, color) {
  const msg = document.createElement("div");
  msg.className = `p-3 mb-4 text-${color}-700 bg-${color}-200 rounded`;
  msg.innerText = text;

  document.querySelector("main").prepend(msg);

  setTimeout(() => msg.remove(), 3000);
}

function addCourseToTable(course) {
  const table = document.querySelector("tbody");

  const row = document.createElement("tr");
  row.className = "border-b";

  row.innerHTML = `
        <td class="p-3 text-center">${course.name}</td>
        <td class="p-3 text-center">${course.category_name}</td>
        <td class="p-3 text-center">${course.course_date}</td>
        <td class="p-3 text-center">${course.course_time}</td>
        <td class="p-3 text-center">${course.duration} min</td>
        <td class="p-3 text-center">${course.max_participants}</td>
    `;

  table.appendChild(row);
}


// delete course
document.querySelectorAll(".delete-btn").forEach(btn => {
  btn.addEventListener("click", async function (e) {
    e.preventDefault();

    const id = this.dataset.id;

    if (!confirm("Delete this course?")) return;

    let response = await fetch("../includes/delete_course.php?id=" + id);

    let result = await response.json();
    console.log(result);

    if (result.status === "success") {
      showMessage("Course deleted.", "green");

      // remove row from table
      this.closest("tr").remove();
    } else {
      showMessage("Error deleting course.", "red");
    }
  });
});

