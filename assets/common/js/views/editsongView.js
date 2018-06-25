// Edit song form logic
$("#youtubelink").change(setVideoPreview);
$("#songtext").on('input', setPreview);
$("#chordinput").on('input', setPreview);
$("#fillchords").click(fillChords);
$("#updatechords").click(setPreview);

$("#trans-up").click(transposeUp);
$("#trans-down").click(transposeDown);
$("#pdfdownload").click(savePDF);

$("#songtext").val($("#songtext").val().replace(/\t/, "        "));
setVideoPreview();
setPreview();



