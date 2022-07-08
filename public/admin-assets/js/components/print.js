const printButton = document.getElementById('print-button');
printButton.addEventListener('click', getPrint);
function getPrint() {
  window.print();
}
