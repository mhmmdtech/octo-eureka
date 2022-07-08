const dashboardForm = document.querySelector('.dashboard-form');
const fileInputs = dashboardForm.querySelectorAll("input[type='file']");

fileInputs.forEach((input) =>
  input.addEventListener('change', handleFileInput)
);

function handleFileInput() {
  let label = get_sibling(this, 'label');
  let hasCover = this.dataset.cover === 'true' ? true : false;
  if (hasCover) {
    label.querySelector('img').src = URL.createObjectURL(this.files[0]);
  } else {
    label.dataset.text = this.files[0].name;
  }
}
