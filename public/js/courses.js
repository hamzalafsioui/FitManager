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

  document.querySelector("main").prepend(msg); // add SMS at first in main

  setTimeout(() => msg.remove(), 3000);
}

function addCourseToTable(course) {
  const table = document.querySelector("tbody");

  const row = document.createElement("tr");
  row.className = "border-b";

  console.log(course);

  row.innerHTML = `
        <td class="p-3 text-center">${course.name}</td>
        <td class="p-3 text-center">${course.category_name}</td>
        <td class="p-3 text-center">${course.course_date}</td>
        <td class="p-3 text-center">${course.course_time}</td>
        <td class="p-3 text-center">${course.duration} min</td>
        <td class="p-3 text-center">${course.max_participants}</td>
        <td class="text-center p-3 space-x-2">
           <a href="#" class="text-blue-600 hover:underline edit-btn" data-id="${course.id}">
                Edit
            </a>

            <a class="text-red-600 hover:underline delete-btn"
               href="#"
               data-id="${course.id}">
                Delete
            </a>
        </td>
    `;

  table.appendChild(row);
  // add event to new row
  attachEditToNewRow(row);
  attachDeleteToNewRow(row);
  //   row
  //     .querySelector(".delete-btn")
  //     .addEventListener("click", handleDeleteCourse);
}

//function to handle Delete course
async function handleDeleteCourse(e) {
  e.preventDefault();

  const id = this.dataset.id;
  if (!confirm("Delete this course?")) return;

  try {
    let response = await fetch("../includes/delete_course.php?id=" + id);
    let result = await response.json();
    console.log(result);

    if (result.status === "success") {
      showMessage("Course deleted.", "green");
      this.closest("tr").remove();
    } else {
      showMessage("Error deleting course.", "red");
    }
  } catch (err) {
    showMessage("Server error.", "red");
  }
}

// handle new row
document.querySelectorAll(".delete-btn").forEach((btn) => {
  btn.addEventListener("click", handleDeleteCourse);
});

// ================= EDIT ===========================

// Modal elements
const editModal = document.getElementById("editModal");
const closeModalBtn = document.getElementById("closeModal");
const editForm = document.getElementById("edit-course-form");

// Function to open edit modal and populate data
async function handleEditCourse(e) {
  e.preventDefault();
  const id = this.dataset.id;

  try {
    const response = await fetch(`../includes/get_course.php?id=${id}`);
    const course = await response.json();

    if (course.status === "success") {
      document.getElementById("edit-course-id").value = course.data.id;
      document.getElementById("edit-course-name").value = course.data.name;
      document.getElementById("edit-course-category").value =
        course.data.category_id;
      document.getElementById("edit-course-date").value =
        course.data.course_date;
      document.getElementById("edit-course-time").value =
        course.data.course_time;
      document.getElementById("edit-course-duration").value =
        course.data.duration;
      document.getElementById("edit-course-max").value =
        course.data.max_participants;

      editModal.classList.remove("hidden");
    } else {
      showMessage("Failed to fetch course data.", "red");
    }
  } catch (err) {
    showMessage("Server error.", "red");
  }
}

// Attach to existing edit buttons
document.querySelectorAll(".edit-btn").forEach((btn) => {
  btn.addEventListener("click", handleEditCourse);
});

// Close modal
closeModalBtn.addEventListener("click", () => {
  editModal.classList.add("hidden");
});

// AJAX
editForm.addEventListener("submit", async function (e) {
  e.preventDefault();
  const formData = new FormData(this);
  const courseId = formData.get("id");

  try {
    const response = await fetch("../includes/update_course.php", {
      method: "POST",
      body: formData,
    });
    const result = await response.json();

    if (result.status === "success") {
      showMessage("Course updated successfully!", "green");

      // Update the row in the table
      const row = document
        .querySelector(`.edit-btn[data-id="${courseId}"]`)
        .closest("tr");
      row.children[0].textContent = formData.get("name");
      row.children[1].textContent = document.getElementById(
        "edit-course-category"
      ).selectedOptions[0].text;
      row.children[2].textContent = formData.get("course_date");
      row.children[3].textContent = formData.get("course_time");
      row.children[4].textContent = formData.get("duration") + " min";
      row.children[5].textContent = formData.get("max_participants");

      // Close modal after update
      editModal.classList.add("hidden");
    } else {
      showMessage("Error updating course.", "red");
    }
  } catch (err) {
    showMessage("Server error.", "red");
  }
});

// Utility
function attachEditToNewRow(row) {
  const editBtn = row.querySelector(".edit-btn");
  if (editBtn) {
    editBtn.addEventListener("click", handleEditCourse);
  }
}

function attachDeleteToNewRow(row) {
  const deleteBtn = row.querySelector(".delete-btn");
  if (deleteBtn) {
    deleteBtn.addEventListener("click", handleDeleteCourse);
  }
}
