@extends('admin.index')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
        
       
@if($download->health_card_type=="Green Health Discount card")
    <style>
        #card {
            background: url({{ asset('/admin_assets/img/healthcard/Backgournd.jpg') }});
            background-size: cover;
            background-repeat: no-repeat;
            width: 100%;
            height: 100%;
        }

        .card-logo {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 15px !important;
}
.left-logo img {
    max-width: 90px;
    width: 100%;
}
.right-logo img {
    max-width: 120px;
    width: 100%;
}

   .img-box {
    width: 200px;
    height: 200px;
    border-radius: 100%;
    overflow: hidden;
    text-align: center;
    margin: auto 0 auto auto;
    border: solid 4px #136834;
    padding: 6px;
}

        .img-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    object-position: top;
}

        .candidate-img-side {
            text-align: center;
        }
        .card-footer {
            text-align: center;
            margin-top: 10px;
        }

        .card-footer h1 {
            text-transform: uppercase;
            font-size:22px;
        }

        .candidate-detail p {
    text-transform: uppercase;
    font-size: 16px;
    margin-bottom: 0;
    line-height: 38px;
    text-align: left;
}

        .candidate-detail p span {
            margin-left: 20px;
        }

        .card-issue span p {
               text-transform: uppercase;
    font-size: 16px;
    margin-bottom: 0;
    line-height: 38px;
    text-align: left;
        }

        .card-issue {
            display: flex;
            justify-content: space-around;
        }
        /*new style*/
        .healthcard_main_box {
    max-width: 800px;
    box-shadow: #000 0px 0px 18px;
    margin: auto;
        position: relative;
}
.card_mideal_parth {
    align-items: center;
}

@media (max-width: 767px){
    .img-box {
    margin: auto auto auto auto;
}
.candidate-detail p {
    font-size: 14px;
    line-height: 32px;
    text-align: center;
}
.card-issue span p {
    text-align: center !important;
    font-size: 14px;
    line-height: 32px;
}
.card-footer h1 {
    font-size: 18px;
}
}
.content-wrapper {
    display: flex;
    align-items: center;
}
.download-button {
    width: 100%;
    position: absolute;
    bottom: 5px;
    right: 5px;
    text-align: end;
        display: none;
}
.download-button a {
    background-color: #f58320;
    border-color: #f58320;
}
.healthcard_main_box:hover .download-button {
    display:block;
}
    </style>
@endif
@if($download->health_card_type=="Silver Health Discount Card")
    <style>
        #card {
            background: url({{ asset('/admin_assets/img/healthcard/PLATINUM.jpg') }});
            background-size: cover;
            background-repeat: no-repeat;
            width: 100%;
            height: 100%;
        }

        .card-logo {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 15px !important;
}
.left-logo img {
    max-width: 90px;
    width: 100%;
}
.right-logo img {
    max-width: 120px;
    width: 100%;
}

   .img-box {
    width: 200px;
    height: 200px;
    border-radius: 100%;
    overflow: hidden;
    text-align: center;
    margin: auto 0 auto auto;
    border: solid 4px #136834;
    padding: 6px;
}

        .img-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    object-position: top;
}

        .candidate-img-side {
            text-align: center;
        }
        .card-footer {
            text-align: center;
            margin-top: 10px;
        }

        .card-footer h1 {
            text-transform: uppercase;
            font-size:22px;
        }

        .candidate-detail p {
    text-transform: uppercase;
    font-size: 16px;
    margin-bottom: 0;
    line-height: 38px;
    text-align: left;
}

        .candidate-detail p span {
            margin-left: 20px;
        }

        .card-issue span p {
               text-transform: uppercase;
    font-size: 16px;
    margin-bottom: 0;
    line-height: 38px;
    text-align: left;
        }

        .card-issue {
            display: flex;
            justify-content: space-around;
        }
        /*new style*/
        .healthcard_main_box {
    max-width: 800px;
    box-shadow: #000 0px 0px 18px;
    margin: auto;
        position: relative;
}
.card_mideal_parth {
    align-items: center;
}

@media (max-width: 767px){
    .img-box {
    margin: auto auto auto auto;
}
.candidate-detail p {
    font-size: 14px;
    line-height: 32px;
    text-align: center;
}
.card-issue span p {
    text-align: center !important;
    font-size: 14px;
    line-height: 32px;
}
.card-footer h1 {
    font-size: 18px;
}
}
.content-wrapper {
    display: flex;
    align-items: center;
}
.download-button {
    width: 100%;
    position: absolute;
    bottom: 5px;
    right: 5px;
    text-align: end;
        display: none;
}
.download-button a {
    background-color: #f58320;
    border-color: #f58320;
}
.healthcard_main_box:hover .download-button {
    display:block;
}
    </style>
@endif
@if($download->health_card_type=="Gold  Health Discount card")
    <style>
        #card {
            background: url({{ asset('/admin_assets/img/healthcard/GOLD.jpg') }});
            background-size: cover;
            background-repeat: no-repeat;
            width: 100%;
            height: 100%;
        }

        .card-logo {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 15px !important;
}
.left-logo img {
    max-width: 90px;
    width: 100%;
}
.right-logo img {
    max-width: 250px;
    width: 100%;
}

   .img-box {
    width: 200px;
    height: 200px;
    border-radius: 100%;
    overflow: hidden;
    text-align: center;
    margin: auto 0 auto auto;
    border: solid 4px #136834;
    padding: 6px;
}

        .img-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    object-position: top;
}

        .candidate-img-side {
            text-align: center;
        }
        .card-footer {
            text-align: center;
            margin-top: 10px;
        }

        .card-footer h1 {
            text-transform: uppercase;
            font-size:22px;
        }

        .candidate-detail p {
    text-transform: uppercase;
    font-size: 16px;
    margin-bottom: 0;
    line-height: 38px;
    text-align: left;
}

        .candidate-detail p span {
            margin-left: 20px;
        }

        .card-issue span p {
               text-transform: uppercase;
    font-size: 16px;
    margin-bottom: 0;
    line-height: 38px;
    text-align: left;
        }

        .card-issue {
            display: flex;
            justify-content: space-around;
        }
        /*new style*/
        .healthcard_main_box {
    max-width: 800px;
    box-shadow: #000 0px 0px 18px;
    margin: auto;
        position: relative;
}
.card_mideal_parth {
    align-items: center;
}

@media (max-width: 767px){
    .img-box {
    margin: auto auto auto auto;
}
.candidate-detail p {
    font-size: 14px;
    line-height: 32px;
    text-align: center;
}
.card-issue span p {
    text-align: center !important;
    font-size: 14px;
    line-height: 32px;
}
.card-footer h1 {
    font-size: 18px;
}
}
.content-wrapper {
    display: flex;
    align-items: center;
}
.download-button {
    width: 100%;
    position: absolute;
    bottom: 5px;
    right: 5px;
    text-align: end;
        display: none;
}
.download-button a {
    background-color: #f58320;
    border-color: #f58320;
}
.healthcard_main_box:hover .download-button {
    display:block;
}
    </style>
@endif
</head>

<body>
    <div class="container">
        <div class="healthcard_main_box">
             <center class="download-button"> 
             <button onclick="Convert_HTML_To_PDF();">Convert HTML to PDF</button>
             {{-- <a href={{ url('admin/download-health-card/'.$download->id.'/generate') }} class="btn btn-primary">Download</a> --}}

             </center>
             <div id="contentToPrint">
    <section id="card">
        <div class="container">
            <div class="row">
                <div class="card-logo p-4">
                    <div class="left-logo me-4">
                        <img src="{{ asset('/admin_assets/img/healthcard/left-logo.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="right-logo ms-4">
                        <img src="{{ asset('/admin_assets/img/healthcard/right-logo.png') }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
            <div class="row card_mideal_parth">
                <div class="col-md-4 candidate-img-side">
                    <div class="candidate-image ">
                        <div class="img-box">
                            <img src="{{ asset('/admin_assets/uploads/healthcardcustomer/'.$download->image) }}"  alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-8 candidate-details-side ps-4">
                    <div class="candidate-detail">
                        <p><b>Name :</b><span>{{ $download->name }}</span></p>
                        <p><b>Card Type :</b><span></span>{{ $download->health_card_type }}</p>
                        <p><b>DOD :</b><span>{{ $download->dob }}</span></p>
                        <p><b>Card No :</b><span>{{ $download->member_id }}</span></p>
                        <p><b>Contact NO :</b><span>{{ $download->mobile }}</span></p>
                    </div>
                </div>
            </div>
            <div class="card-issue row">
                 <span class="col-md-6">
                    <p style="text-align: end;"><b> Date of Issued :</b>{{ date('d-m-Y ',strtotime($download->card_reg_start)); }} </p>
                </span>
                <span class="col-md-6">
                    <p style="text-align: start;"><b> Date of Expiry :</b>{{ date('d-m-Y ',strtotime($download->card_reg_end)); }} </p>
                </span>
               
            </div>
            <div class="card-footer pb-3">
                <h1>Health id no: {{ $download->health_card_issue_id_no }}</h1>
            </div>
        </div>
    </section>
    </div>
        </div>
    </div>
 





</body>
        
  <script>
window.jsPDF = window.jspdf.jsPDF;

// Generate 2 pages PDF document
function generatePDF() {
	var doc = new jsPDF();
	
	doc.text(20, 20, 'Hello world!');
	doc.text(20, 30, 'This is client-side Javascript to generate a PDF.');
	
	// Add new page
	doc.addPage();
	doc.text(20, 20, 'Visit CodexWorld.com');
	
	// Save the PDF
	doc.save('document.pdf');
}

// Generate PDF document with landscape orientation
function generatePDF_2() {
	
	var doc = new jsPDF({
		orientation: 'landscape'
	});
	
	doc.text(20, 20, 'Hello world!');
	doc.text(20, 30, 'This is client-side Javascript to generate a PDF.');
	
	// Add new page
	doc.addPage();
	doc.text(20, 20, 'Visit CodexWorld.com');
	
	// Save the PDF
	doc.save('document.pdf');
}

// Generate PDF document with different fonts
function generatePDF_3() {
	var doc = new jsPDF();
	
	doc.text(20, 20, 'This is the default font.');

	doc.setFont("courier", "normal");
	doc.text("This is courier normal.", 20, 30);

	doc.setFont("times", "italic");
	doc.text("This is times italic.", 20, 40);

	doc.setFont("helvetica", "bold");
	doc.text("This is helvetica bold.", 20, 50);

	doc.setFont("courier", "bolditalic");
	doc.text("This is courier bolditalic.", 20, 60);

	doc.setFont("times", "normal");
	doc.text("This is centred text.", 105, 80, null, null, "center");
	doc.text("And a little bit more underneath it.", 105, 90, null, null, "center");
	doc.text("This is right aligned text", 200, 100, null, null, "right");
	doc.text("And some more", 200, 110, null, null, "right");
	doc.text("Back to left", 20, 120);

	doc.text("10 degrees rotated", 20, 140, null, 10);
	doc.text("-10 degrees rotated", 20, 160, null, -10);
	
	// Save the PDF
	doc.save('document.pdf');
}

// Generate PDF document with different font size
function generatePDF_4() {
	var doc = new jsPDF();

	doc.setFontSize(24);
	doc.text("This is a title", 20, 20);

	doc.setFontSize(16);
	doc.text("This is some normal sized text underneath.", 20, 30);
	
	// Save the PDF
	doc.save('document.pdf');
}

// Generate PDF document with different font color
function generatePDF_5() {
	var doc = new jsPDF();

	doc.setTextColor(100);
	doc.text("This is gray.", 20, 20);

	doc.setTextColor(150);
	doc.text("This is light gray.", 20, 30);

	doc.setTextColor(255, 0, 0);
	doc.text("This is red.", 20, 40);

	doc.setTextColor(0, 255, 0);
	doc.text("This is green.", 20, 50);

	doc.setTextColor(0, 0, 255);
	doc.text("This is blue.", 20, 60);

	doc.setTextColor("red");
	doc.text("This is red.", 60, 40);

	doc.setTextColor("green");
	doc.text("This is green.", 60, 50);

	doc.setTextColor("blue");
	doc.text("This is blue.", 60, 60);
	
	// Save the PDF
	doc.save('document.pdf');
}

// Generate PDF document with image
function generatePDF_6() {
	var doc = new jsPDF();

	doc.setFontSize(24);
	doc.text("This is a title", 20, 20);

	doc.setFontSize(16);
	doc.text("This is some normal sized text underneath.", 20, 30);

	// Add image
	doc.addImage("images/flowers.jpg", "JPEG", 15, 40, 180, 180);
	
	// Save the PDF
	doc.save('document.pdf');
}

/*
 * Convert HTML content to PDF
 */
function Convert_HTML_To_PDF() {
	var doc = new jsPDF();
	
	// Source HTMLElement or a string containing HTML.
	var elementHTML = document.querySelector("#contentToPrint");

	doc.html(elementHTML, {
		callback: function(doc) {
			// Save the PDF
			doc.save('document-html.pdf');
		},
		margin: [10, 10, 10, 10],
		autoPaging: 'text',
		x: 0,
		y: 0,
		width: 190, // Target width in the PDF document
		windowWidth: 675 // Window width in CSS pixels
	});
}
</script>      
 
@endsection
