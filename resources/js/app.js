import "./bootstrap";

// Constants
const OPEN_MODAL_BTN = "open_model";
const CLOSE_MODAL_BTN = "close_model";
const MODAL = "model";
const USER_FORM = "user_form";
const FILE_INPUT = "profile";
const FILE_NAME = "file_name";
const ALERT_BOX = "alert_box";

const USERS_API_URL = "/api/users";

const NO_FILE_CHOSEN = "No file chosen";
const REQUIRED_FIELDS_ERROR = (fields) =>
    `${fields.join(", ")} are required fields`;

// Constants for hardcoded strings
const ADD_SHADOW = "add_shadow";
const OPEN = "open";
const CLOSE = "close";
const ERROR = "error";
const SUCCESS = "success";
const FORM_ALERT_BOX = "form_alert_box";
const TABLE_ALERT_BOX = "table_alert_box";
const REMOVE_ALERT = "remove_alert";
const NO_IMAGE = "No Image";

// Modal Toggle Functions
const openModalBtn = document.getElementById(OPEN_MODAL_BTN);
const closeModalBtn = document.getElementById(CLOSE_MODAL_BTN);
const modal = document.getElementById(MODAL);

const toggleModal = (isOpen) => {
    modal.classList.toggle(OPEN, isOpen);
    modal.classList.toggle(CLOSE, !isOpen);
};

// Open and Close Modal Event Listeners
openModalBtn.addEventListener("click", () => {
    toggleModal(true);
    document.body.classList.add(ADD_SHADOW);

    // Reset the form before opening the user form
    const userForm = document.getElementById(USER_FORM);
    if (userForm) userForm.reset();
});

closeModalBtn.addEventListener("click", () => {
    toggleModal(false);
    document.body.classList.remove(ADD_SHADOW);
});

// File Upload Handler
document.getElementById(FILE_INPUT).addEventListener("change", function () {
    const fileName = this.files[0]?.name || NO_FILE_CHOSEN;
    document.getElementById(FILE_NAME).innerHTML = fileName;
});

// Form Submission and Validation
const userRegistrationForm = document.getElementById(USER_FORM);

userRegistrationForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const userData = new FormData(userRegistrationForm);
    const isValid = validateUserData(userData);

    if (!isValid) return;

    const isSubmitted = await submitUserData(userData);

    if (isSubmitted) userRegistrationForm.reset();
});

// Validate User Data
function validateUserData(userData) {
    const invalidFields = [];

    userData.forEach((value, key) => {
        if (!value) invalidFields.push(key);
    });

    if (invalidFields.length > 0) {
        showAlert(ERROR, REQUIRED_FIELDS_ERROR(invalidFields), FORM_ALERT_BOX);
        return false;
    }

    return true;
}

// Submit User Data to API
async function submitUserData(userData) {
    try {
        const response = await fetch(USERS_API_URL, {
            method: "POST",
            body: userData,
        });
        const result = await response.json();

        if (result.status !== "OK") {
            showAlert(ERROR, result.errors, FORM_ALERT_BOX);
            return false;
        }

        // On user added successfully close the form modal
        toggleModal(false);
        document.body.classList.remove(ADD_SHADOW);

        showAlert(SUCCESS, result.message, TABLE_ALERT_BOX);
        await fetchUsers();
    } catch (error) {
        showAlert(ERROR, error, FORM_ALERT_BOX);
        return false;
    }

    return true;
}

// Alert Functionality
const alertIcons = {
    success: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>`,
    error: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24l0 112c0 13.3-10.7 24-24 24s-24-10.7-24-24l0-112c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/></svg>`,
};

function showAlert(type, message, boxId) {
    const alertBox = document.getElementById(boxId);
    const alertContent = document.getElementById(`${boxId}_content`);

    alertContent.innerHTML = `${alertIcons[type]}<span>${message}</span>`;
    alertBox.classList.add(type);

    setTimeout(() => {
        alertBox.classList.add(REMOVE_ALERT);
        alertBox.className = ALERT_BOX; // Changed to use the constant ALERT_BOX
        alertContent.innerHTML = "";
    }, 3000);
}

// User roles
const userRoles = {
    1: "Admin",
    2: "User",
};

// Call API to fetch users
async function fetchUsers() {
    try {
        const response = await fetch(USERS_API_URL);
        const users = await response.json();
        const tbody = document.querySelector("table tbody");

        tbody.innerHTML = users
            .map(
                (user) => `
            <tr>
                <td>${user.id}</td>
                <td>${
                    user.profile
                        ? `<img class="profile" src="/storage/${user.profile}" alt="Profile Image">`
                        : NO_IMAGE
                }</td>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>${user.phone}</td>
                <td>${user.description}</td>
                <td>${userRoles[user.role_id]}</td>
            </tr>
        `
            )
            .join("");
    } catch (error) {
        showAlert(ERROR, error, TABLE_ALERT_BOX);
    }
}

// Fetch all users on page load
window.onload = fetchUsers;