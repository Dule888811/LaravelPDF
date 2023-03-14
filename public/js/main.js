var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
    backgroundColor: 'rgba(255, 255, 255, 0)',
    penColor: 'rgb(0, 0, 0)'
});

var cancelButton = document.getElementById('clear');
var saveButton = document.querySelector('#save');


cancelButton.addEventListener('click', function (event) {
    signaturePad.clear();
});var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
    backgroundColor: 'rgba(255, 255, 255, 0)',
    penColor: 'rgb(0, 0, 0)'
});

var cancelButton = document.getElementById('clear');

saveButton.addEventListener('click', function (e) {
    document.querySelector('[name=signature_data]').value = signaturePad.toDataURL('image/png', 100);
});

cancelButton.addEventListener('click', function (event) {
    signaturePad.clear();
});