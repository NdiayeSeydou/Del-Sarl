<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Facture pro forma</title>
<style>
  * { box-sizing:border-box; }
  .row { display:table; width:100%; table-layout:fixed; }
  .col-5,.col-7 { display:table-cell; vertical-align:top; }
  .col-5 { width:41.666%; } .col-7 { width:58.334%; }
  .text-end { text-align:right; } .text-center { text-align:center; }
  .table { width:100%; border-collapse:collapse; }
  .table th,.table td { padding:8px; }
  .table-responsive { width:100%; }
  .d-block { display:block; } .fs-6 { font-size:.9rem; }
  .mb-0 { margin-bottom:0; } .mb-3 { margin-bottom:14px; }
  .mb-4 { margin-bottom:20px; } .mt-2 { margin-top:8px; }
  .pe-2 { padding-right:8px; }
</style>
<style>
  body { background:#e9ecef; }
  .facture { background:#fff; max-width:850px; margin:20px auto; padding:40px 45px; box-shadow:0 0 12px rgba(0,0,0,.15); font-family:Arial, Helvetica, sans-serif; color:#222; }
  .logo-box { font-size:3.2rem; font-weight:900; font-style:italic; letter-spacing:-2px; line-height:1; }
  .logo-sub { font-size:.8rem; font-weight:700; letter-spacing:1px; color:#333; }
  .societe { font-weight:700; letter-spacing:1px; font-size:1.05rem; }
  .entete-info { font-size:.85rem; }
  .double-line { border-top:4px solid #222; border-bottom:2px solid #222; height:10px; margin:14px 0 30px; }
  .titre { text-align:center; font-weight:800; letter-spacing:4px; font-size:1.8rem; margin:25px 0 35px; }
  .label { font-size:.72rem; font-weight:700; letter-spacing:1px; color:#555; text-transform:uppercase; }
  .valeur { font-weight:700; }
  .table-facture thead th { background:#222; color:#fff; border:0; font-weight:700; }
  .table-facture tbody td { border-color:transparent; padding:.7rem .5rem; }
  .table-facture tfoot td { background:#222; color:#fff; font-weight:700; font-size:1.05rem; border:0; }
  .arrete { font-size:.95rem; margin-top:25px; }
  .direction { text-align:right; font-weight:700; letter-spacing:2px; margin-top:40px; padding-right:60px; }
  @media print {
    body { background:#fff; }
    .facture { box-shadow:none; margin:0; max-width:100%; }
    * { -webkit-print-color-adjust:exact; print-color-adjust:exact; }
  }
</style>
</head>
<body>
<div class="facture">

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

  <h1 class="titre">FACTURE PRO FORMA</h1>
  <div class="text-center fw-bold mb-4">N° {{ $proforma->num_proforma }}</div>

  <!-- CLIENT / DATE -->
  <div class="row mb-4">
    <div class="col-7">
      <div class="label">Client</div>
      <div class="valeur">{{ $proforma->client }}</div>
    </div>
    <div class="col-5">
      <div class="label">Date</div>
      <div class="valeur mb-3">Bamako, le {{ \Carbon\Carbon::parse($proforma->date_proforma)->format('d/m/Y') }}</div>
      <div class="label">Devise</div>
      <div class="valeur">{{ $proforma->devise }}</div>
    </div>
  </div>

  <!-- TABLEAU -->
  <div class="table-responsive">
    <table class="table table-facture align-middle mb-0">
      <thead>
        <tr>
          <th style="width:50px">N°</th>
          <th>Désignation</th>
          <th class="text-center" style="width:60px">Qté</th>
          <th class="text-end" style="width:130px">Prix unitaire</th>
          <th class="text-end" style="width:130px">Prix total</th>
        </tr>
      </thead>
      <tbody>
        @foreach($proforma->articles as $article)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $article->designation }}</td>
            <td class="text-center">{{ $article->quantite }}</td>
            <td class="text-end">{{ number_format($article->prix_unitaire, 0, ',', ' ') }}</td>
            <td class="text-end">{{ number_format($article->prix_total, 0, ',', ' ') }}</td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="4" class="text-end">TOTAL HT ({{ $proforma->devise }})</td>
          <td class="text-end">{{ number_format($proforma->subtotal_ht, 0, ',', ' ') }}</td>
        </tr>
        @if($proforma->appliquer_remise)
          <tr><td colspan="4" class="text-end">Remise ({{ $proforma->remise_pourcentage }} %)</td><td class="text-end">-{{ number_format($proforma->montant_remise, 0, ',', ' ') }}</td></tr>
        @endif
        @if($proforma->appliquer_tva)
          <tr><td colspan="4" class="text-end">TVA ({{ $proforma->tva_pourcentage }} %)</td><td class="text-end">{{ number_format($proforma->montant_tva, 0, ',', ' ') }}</td></tr>
        @endif
        <tr><td colspan="4" class="text-end">TOTAL TTC</td><td class="text-end">{{ number_format($proforma->grand_total, 0, ',', ' ') }}</td></tr>
      </tfoot>
    </table>
  </div>

  <p class="arrete">
    Arrêtée la présente facture pro forma à la somme de :<br>
    <strong>{{ $proforma->montant_lettres ?: number_format($proforma->grand_total, 0, ',', ' ') . ' ' . $proforma->devise }}</strong>
  </p>

  <p class="small">{{ $proforma->remarques }}</p>

  <div class="direction">LA DIRECTION</div>
</div>

{{-- <script>
// ===== DONNÉES (à remplacer par celles de votre application) =====
const facture = {
  societe: {
    nom: "DOUCOURÉ ÉQUIPEMENT ET LOGISTIQUE SARL",
    adresse: "Hamdallaye ACI 2000 - Bamako, Mali",
    tel: "Tél. : +223 94 34 77 57 / +223 66 75 63 29",
    email: "Email : delsarl15@gmail.com"
  },
  client: "MINISTÈRE DE L'ADMINISTRATION TERRITORIALE ET DE LA DÉCENTRALISATION",
  date: "Bamako, le 28/09/2026",
  devise: "Franc CFA (XOF)",
  lignes: [
    { designation: "Photocopieur CANON imageRUNNER 4745i", qte: 1, pu: 7445000 },
    { designation: "Photocopieur CANON imageRUNNER ADVANCE 6568i", qte: 1, pu: 13868750 },
    { designation: "Scanner HP ScanJet Pro N4600 fnw1", qte: 4, pu: 1362500 },
    { designation: "Stabilisateur 5KVA", qte: 1, pu: 222000 }
  ],
  // À générer automatiquement dans votre appli (conversion chiffres → lettres)
  totalLettres: "Vingt-six millions neuf cent quatre vingt-cinq mille sept cent cinquante (26 985 750) francs CFA hors taxes."
};

// ===== RENDU =====
const fmt = n => new Intl.NumberFormat("fr-FR").format(n).replace(/[\u202f\u00a0]/g, " ");
const $ = id => document.getElementById(id);

$("societe-nom").textContent = facture.societe.nom;
$("societe-adresse").textContent = facture.societe.adresse;
$("societe-tel").textContent = facture.societe.tel;
$("societe-email").textContent = facture.societe.email;
$("client").textContent = facture.client;
$("date").textContent = facture.date;
$("devise").textContent = facture.devise;

let total = 0;
$("lignes").innerHTML = facture.lignes.map((l, i) => {
  const t = l.qte * l.pu; total += t;
  return `<tr>
    <td>${i + 1}</td>
    <td>${l.designation}</td>
    <td class="text-center">${l.qte}</td>
    <td class="text-end">${fmt(l.pu)}</td>
    <td class="text-end">${fmt(t)}</td>
  </tr>`;
}).join("");
$("total").textContent = fmt(total);
$("total-lettres").textContent = facture.totalLettres;
</script> --}}
</body>
</html>
