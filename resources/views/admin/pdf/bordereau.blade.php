<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bordereau de livraison</title>
<style>
  * { box-sizing:border-box; }
  .row { display:table; width:100%; table-layout:fixed; }
  .col-5,.col-6,.col-7 { display:table-cell; vertical-align:top; }
  .col-5 { width:41.666%; } .col-7 { width:58.334%; } .col-6 { width:50%; }
  .text-end { text-align:right; } .text-center { text-align:center; }
  .table { width:100%; border-collapse:collapse; }
  .table th,.table td { padding:8px; }
  .table-responsive { width:100%; }
  .small { font-size:.8rem; } .mb-0 { margin-bottom:0; }
  .mb-2 { margin-bottom:8px; } .mb-4 { margin-bottom:20px; }
  .mt-3 { margin-top:14px; } .mt-4 { margin-top:20px; }
</style>
<style>
  :root { --bleu:#0b4f86; --bleu-clair:#1b78b8; }
  body { background:#e9ecef; }
  .bl { background:#fff; max-width:850px; margin:20px auto; padding:40px 45px 30px; box-shadow:0 0 12px rgba(0,0,0,.15); font-family:Verdana, Arial, sans-serif; color:#222; font-size:.9rem; }
  .logo-box { font-size:3.2rem; font-weight:900; font-style:italic; letter-spacing:-2px; line-height:1; color:var(--bleu-clair); }
  .logo-sub { font-size:.72rem; font-weight:700; letter-spacing:1px; color:#333; }
  .societe { font-weight:700; color:var(--bleu); font-size:.95rem; }
  .entete-info { font-size:.78rem; }
  .double-line { border-top:4px solid var(--bleu-clair); border-bottom:2px solid var(--bleu); height:9px; margin:14px 0 30px; }
  .titre { text-align:center; font-weight:800; letter-spacing:3px; font-size:1.5rem; color:var(--bleu); margin:25px 0 30px; }
  .label { font-size:.68rem; font-weight:700; letter-spacing:1px; color:var(--bleu); text-transform:uppercase; }
  .valeur { font-weight:700; }
  .pointilles { border-bottom:2px dotted #333; height:1.2rem; min-width:220px; }
  .table-bl thead th { background:var(--bleu); color:#fff; border:0; font-weight:700; }
  .table-bl tbody td { border-color:transparent; padding:.7rem .5rem; }
  .table-bl tfoot td { background:var(--bleu); color:#fff; font-weight:700; border:0; }
  .bloc-signature { min-height:170px; }
  .ligne-saisie { display:inline-block; min-width:170px; border-bottom:1px dotted #333; }
  .pied { font-size:.7rem; text-align:center; color:#444; margin-top:30px; }
  @media print {
    body { background:#fff; }
    .bl { box-shadow:none; margin:0; max-width:100%; }
    * { -webkit-print-color-adjust:exact; print-color-adjust:exact; }
  }
</style>
</head>
<body>
<div class="bl">

  <!-- EN-TÊTE -->
  <div class="row align-items-center">
    <div class="col-5">
      <div class="logo-box">DEL<small class="d-block fs-6 fst-normal text-end pe-2">SARL</small></div>
      <div class="logo-sub">INTÉGRATEUR DE SOLUTIONS</div>
    </div>
    <div class="col-7 text-end entete-info">
      <div class="societe">DOUCOURÉ ÉQUIPEMENT ET LOGISTIQUE SARL</div>
      <div>Hamdallaye ACI 2000 – Bamako, Mali</div>
      <div>Tél. : +223 94 34 77 57 / +223 66 75 63 29</div>
      <div>Email : delsarl15@gmail.com</div>
    </div>
  </div>
  <div class="double-line"></div>

  <h1 class="titre">BORDEREAU DE LIVRAISON</h1>

  <!-- CLIENT / DATE / N° BL -->
  <div class="row mb-4">
    <div class="col-7">
      <div class="label">Client / Destinataire</div>
      <div class="valeur">{{ $bordereau->client }}</div>
    </div>
    <div class="col-5">
      <div class="label">Date de livraison</div>
      <div class="valeur mb-2">Bamako, le {{ \Carbon\Carbon::parse($bordereau->date_livraison)->format('d/m/Y') }}</div>
      <div class="label">N° BL</div>
      <div class="pointilles valeur">{{ $bordereau->num_bl }}</div>
    </div>
  </div>

  <p class="mb-4"><span class="label" style="font-size:.8rem">Référence :</span> <span>{{ $bordereau->reference ?: '—' }}</span></p>

  <!-- TABLEAU -->
  <div class="table-responsive">
    <table class="table table-bl align-middle mb-0">
      <thead>
        <tr>
          <th style="width:50px">N°</th>
          <th>Désignation</th>
          <th class="text-center" style="width:90px">Qté livrée</th>
          <th style="width:170px">Observations</th>
        </tr>
      </thead>
      <tbody>
        @foreach($bordereau->articles as $article)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $article->designation }}</td>
            <td class="text-center">{{ $article->quantite }}</td>
            <td>{{ $article->observations }}</td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2" class="text-center">TOTAL ARTICLES LIVRÉS</td>
          <td class="text-center">{{ $bordereau->total_quantite }}</td>
          <td></td>
        </tr>
      </tfoot>
    </table>
  </div>

  <p class="mt-3">Le destinataire reconnaît avoir reçu le matériel ci-dessus en bon état et conforme à la commande.</p>

  <!-- SIGNATURES -->
  <div class="row mt-4">
    <div class="col-6 bloc-signature">
      <div class="fw-bold" style="color:var(--bleu)">POUR DEL SARL</div>
      <div class="small mb-2">La Direction</div>
      <div class="mb-2">Nom : <span class="ligne-saisie">{{ $bordereau->emetteur_nom }}</span></div>
      <div class="mb-2">Fonction : <span class="ligne-saisie">{{ $bordereau->emetteur_fonction }}</span></div>
      <div>Signature et cachet :</div>
    </div>
    <div class="col-6 bloc-signature">
      <div class="fw-bold" style="color:var(--bleu)">POUR LE CLIENT</div>
      <div class="small mb-2">Réceptionnaire</div>
      <div class="mb-2">Nom : <span class="ligne-saisie">{{ $bordereau->recepteur_nom }}</span></div>
      <div class="mb-2">Fonction : <span class="ligne-saisie">{{ $bordereau->recepteur_fonction }}</span></div>
      <div>Signature et cachet :</div>
    </div>
  </div>

  <div class="pied"><strong>DEL SARL – Fournisseur & Intégrateur de Solutions Techniques</strong><br>RCCM : Ma.Bko.2015.B.703 | NIF : 084123008N | Hamdallaye ACI 2000, Bamako – Mali</div>
</div>

{{-- <script>
// ===== DONNÉES (à remplacer par celles de votre application) =====
const bl = {
  societe: {
    nom: "DOUCOURÉ ÉQUIPEMENT ET LOGISTIQUE SARL",
    adresse: "Hamdallaye ACI 2000 – Bamako, Mali",
    tel: "Tél. : +223 94 34 77 57 / +223 66 75 63 29",
    email: "Email : delsarl15@gmail.com",
    pied: "<strong>DEL SARL – Fournisseur & Intégrateur de Solutions Techniques</strong><br>RCCM : Ma.Bko.2015.B.703 | NIF : 084123008N | Hamdallaye ACI 2000, Bamako – Mali"
  },
  client: "MINISTÈRE DE L'ADMINISTRATION TERRITORIALE ET DE LA DÉCENTRALISATION",
  date: "Bamako, le 25/09/2026",
  numero: "",
  reference: "Facture pro forma DEL SARL du 25/09/2026",
  lignes: [
    { designation: "Photocopieur CANON imageRUNNER 4745i", qte: 1, obs: "" },
    { designation: "Photocopieur CANON imageRUNNER ADVANCE 6568i", qte: 1, obs: "" },
    { designation: "Scanner HP ScanJet Pro N4600 fnw1", qte: 4, obs: "" }
  ],
  delSignataire: { nom: "", fonction: "" },
  clientSignataire: { nom: "", fonction: "" }
};

// ===== RENDU =====
const $ = id => document.getElementById(id);
$("societe-nom").textContent = bl.societe.nom;
$("societe-adresse").textContent = bl.societe.adresse;
$("societe-tel").textContent = bl.societe.tel;
$("societe-email").textContent = bl.societe.email;
$("client").textContent = bl.client;
$("date").textContent = bl.date;
$("numero").textContent = bl.numero;
$("reference").textContent = bl.reference;
$("del-nom").textContent = bl.delSignataire.nom;
$("del-fonction").textContent = bl.delSignataire.fonction;
$("client-nom").textContent = bl.clientSignataire.nom;
$("client-fonction").textContent = bl.clientSignataire.fonction;
$("pied").innerHTML = bl.societe.pied;

$("lignes").innerHTML = bl.lignes.map((l, i) => `<tr>
  <td>${i + 1}</td>
  <td>${l.designation}</td>
  <td class="text-center">${l.qte}</td>
  <td>${l.obs}</td>
</tr>`).join("");
$("total").textContent = bl.lignes.reduce((s, l) => s + l.qte, 0);
</script> --}}
</body>
</html>
