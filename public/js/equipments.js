console.log(document.getElementById("equipment-form"));
console.log("equipments.js loaded");

// ===== ADD EQUIPMENT =====
document.getElementById("equipment-form").addEventListener("submit", async function (e) {
  e.preventDefault();
  const formData = new FormData(this);

  try {
    const response = await fetch("../includes/add_equipment.php", {
      method: "POST",
      body: formData
    });

    const result = await response.json();
    console.log(result);

    if (result.status === "success") {
      showMessage("Equipment added successfully!", "green");
      addEquipmentToTable(result.equipment); // add new equipment to table by use return data from PHP
      this.reset();
    } else {
      showMessage(result.message || "Error adding equipment.", "red");
    }
  } catch (err) {
    console.error(err);
    showMessage("Server error.", "red");
  }
});

// ===== SHOW MESSAGES =====
function showMessage(text, color) {
  const msg = document.createElement("div");
  msg.className = `p-3 mb-4 text-${color}-700 bg-${color}-200 rounded`;
  msg.innerText = text;
  document.querySelector("main").prepend(msg);
  setTimeout(() => msg.remove(), 3000); // display message only for 3s
}

// ===== ADD ROW TO TABLE =====
function addEquipmentToTable(equipment) {
  const table = document.querySelector("#equipments-table");

  const row = document.createElement("tr");
  row.className = "border-b";
  row.innerHTML = `
    <td class="p-3 text-center">${equipment.name}</td>
    <td class="p-3 text-center">${equipment.type_name}</td>
    <td class="p-3 text-center">${equipment.quantity}</td>
    <td class="p-3 text-center">${equipment.state_name}</td>
    <td class="p-3 text-center space-x-2">
      <a href="#" data-id="${equipment.id}" class="edit-btn text-green-600 hover:underline font-semibold">Edit</a>
      <a href="#" data-id="${equipment.id}" class="delete-btn text-red-600 hover:underline font-semibold">Delete</a>
    </td>
  `;
  table.appendChild(row);

  attachEditToNewRow(row); // handle new row [EDIT]
  attachDeleteToNewRow(row); // handle new row [DELETE]
}

// ===== DELETE EQUIPMENT =====
async function handleDeleteEquipment(e) {
  e.preventDefault();
  const id = this.dataset.id;

  if (!confirm("Delete this equipment?")) return;

  try {
    const response = await fetch(`../includes/delete_equipment.php?id=${id}`);
    const result = await response.json();
    console.log(result);

    if (result.status === "success") {
      showMessage("Equipment deleted.", "green");
      this.closest("tr").remove();
    } else if (result.status === "error" && result.message) {
      alert(result.message);
    } else {
      showMessage(result.message || "Error deleting equipment.", "red");
    }

  } catch (err) {
    console.error(err);
    showMessage("Server error.", "red");
  }
}


// add event to new row
document.querySelectorAll(".delete-btn").forEach(btn => {
  btn.addEventListener("click", handleDeleteEquipment);
});

// ===== EDIT EQUIPMENT =====
const editModal = document.getElementById("editEquipModal");
const closeModalBtn = document.getElementById("closeEquipModal");
const editForm = document.getElementById("edit-equipment-form");

async function handleEditEquipment(e) {
  e.preventDefault();
  const id = this.dataset.id; // USE dataset to get equipment data

  try {
    const response = await fetch(`../includes/get_equipment.php?id=${id}`);
    const result = await response.json();
    console.log(result);

    if (result.status === "success") {
      const equip = result.data;

      document.getElementById("edit-equipment-id").value = equip.id;
      document.getElementById("edit-equipment-name").value = equip.name;
      document.getElementById("edit-equipment-type").value = equip.type_id;
      document.getElementById("edit-equipment-quantity").value = equip.quantity;
      document.getElementById("edit-equipment-state").value = equip.state_id;

      editModal.classList.remove("hidden");
    } else {
      showMessage(result.message || "Failed to fetch equipment data.", "red");
    }
  } catch (err) {
    console.error(err);
    showMessage("Server error.", "red");
  }
}

// add event to new row
document.querySelectorAll(".edit-btn").forEach(btn => {
  btn.addEventListener("click", handleEditEquipment);
});

// Close modal
closeModalBtn.addEventListener("click", () => {
  editModal.classList.add("hidden");
});

// ===== SUBMIT EDIT FORM =======
editForm.addEventListener("submit", async function(e) {
  e.preventDefault();
  const formData = new FormData(this); // use class FormData to store data form into object
  const id = formData.get("id"); // get equipmentId to add it to btns

  try {
    const response = await fetch("../includes/update_equipment.php", {
      method: "POST",
      body: formData
    });
    const result = await response.json();
    console.log(result);

    if (result.status === "success") {
      showMessage("Equipment updated successfully!", "green");

      const row = document.querySelector(`.edit-btn[data-id="${id}"]`).closest("tr"); // get anchor tr
      row.children[0].textContent = formData.get("name");
      row.children[1].textContent = document.getElementById("edit-equipment-type").selectedOptions[0].text;
      row.children[2].textContent = formData.get("quantity");
      row.children[3].textContent = document.getElementById("edit-equipment-state").selectedOptions[0].text;

      editModal.classList.add("hidden");
    } else {
      showMessage(result.message || "Error updating equipment.", "red");
    }
  } catch (err) {
    console.error(err);
    showMessage("Server error.", "red");
  }
});

// ===== UTILITY =====
function attachEditToNewRow(row) {
  const editBtn = row.querySelector(".edit-btn");
  if (editBtn) editBtn.addEventListener("click", handleEditEquipment);
}

function attachDeleteToNewRow(row) {
  const deleteBtn = row.querySelector(".delete-btn");
  if (deleteBtn) deleteBtn.addEventListener("click", handleDeleteEquipment);
}
