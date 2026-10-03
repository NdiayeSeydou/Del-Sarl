<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Facture</title>
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
  .mb-0 { margin-bottom:0; } .mb-2 { margin-bottom:8px; }
  .mb-3 { margin-bottom:14px; } .mb-4 { margin-bottom:20px; }
  .mt-2 { margin-top:8px; } .pe-2 { padding-right:8px; }
</style>
<style>
  :root { --bleu:#0b4f86; --bleu-clair:#1b78b8; }
  body { background:#e9ecef; }
  .facture { background:#fff; max-width:850px; margin:20px auto; padding:40px 45px 30px; box-shadow:0 0 12px rgba(0,0,0,.15); font-family:Verdana, Arial, sans-serif; color:#222; font-size:.9rem; }
  .logo-box { font-size:3.2rem; font-weight:900; font-style:italic; letter-spacing:-2px; line-height:1; color:var(--bleu-clair); }
  .logo-sub { font-size:.72rem; font-weight:700; letter-spacing:1px; color:#333; }
  .societe { font-weight:700; color:var(--bleu); font-size:.95rem; }
  .entete-info { font-size:.78rem; }
  .double-line { border-top:4px solid var(--bleu-clair); border-bottom:2px solid var(--bleu); height:9px; margin:14px 0 28px; }
  .titre { text-align:center; font-weight:800; letter-spacing:4px; font-size:1.6rem; color:var(--bleu); margin:20px 0 6px; }
  .numero { text-align:center; font-weight:700; margin-bottom:26px; }
  .label { font-size:.68rem; font-weight:700; letter-spacing:1px; color:var(--bleu); text-transform:uppercase; }
  .valeur { font-weight:700; }
  .table-facture thead th { background:var(--bleu); color:#fff; border:0; font-weight:700; }
  .table-facture tbody td { border-color:transparent; padding:.7rem .5rem; }
  .totaux { margin-left:auto; width:340px; }
  .totaux td { padding:.45rem .6rem; border:0; }
  .totaux tr.ttc td { background:var(--bleu); color:#fff; font-weight:700; font-size:1.05rem; }
  .totaux tr.ht td, .totaux tr.tva td { background:#eef3f8; font-weight:600; }
  .arrete { margin-top:22px; }
  .direction { text-align:right; font-weight:700; letter-spacing:2px; margin-top:40px; padding-right:50px; color:var(--bleu); }
  .pied { font-size:.7rem; text-align:center; color:#444; margin-top:35px; }
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

  <h1 class="titre">FACTURE</h1>
  <div class="numero">N° {{ $facture->num_facture }}</div>

  <!-- CLIENT / INFOS -->
  <div class="row mb-4">
    <div class="col-7">
      <div class="label">Client</div>
      <div class="valeur mb-3">{{ $facture->client }}</div>
      <div class="label">Statut de paiement</div>
      <div class="valeur">{{ ucfirst(str_replace('_', ' ', $facture->statut_paiement)) }}</div>
    </div>
    <div class="col-5">
      <div class="label">Date</div>
      <div class="valeur mb-2">Bamako, le {{ \Carbon\Carbon::parse($facture->date_facture)->format('d/m/Y') }}</div>
      <div class="label">Date d'échéance</div>
      <div class="valeur mb-2">{{ $facture->date_echeance ? \Carbon\Carbon::parse($facture->date_echeance)->format('d/m/Y') : '—' }}</div>
      <div class="label">Devise</div>
      <div class="valeur">Franc CFA (XOF)</div>
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
          <th class="text-end" style="width:130px">Prix unitaire HT</th>
          <th class="text-end" style="width:130px">Prix total HT</th>
        </tr>
      </thead>
      <tbody>
        @foreach($facture->articles as $article)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $article->designation }}</td>
            <td class="text-center">{{ $article->quantite }}</td>
            <td class="text-end">{{ number_format($article->prix_unitaire, 0, ',', ' ') }}</td>
            <td class="text-end">{{ number_format($article->prix_total, 0, ',', ' ') }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- TOTAUX -->
  <table class="totaux mt-2">
    <tr class="ht"><td>TOTAL HT (FCFA)</td><td class="text-end">{{ number_format($facture->subtotal_ht, 0, ',', ' ') }}</td></tr>
    @if($facture->appliquer_tva)
      <tr class="tva"><td>TVA ({{ $facture->tva_pourcentage }} %)</td><td class="text-end">{{ number_format($facture->montant_tva, 0, ',', ' ') }}</td></tr>
    @endif
    @if($facture->appliquer_remise)
      <tr class="tva"><td>Remise ({{ $facture->remise_pourcentage }} %)</td><td class="text-end">-{{ number_format($facture->montant_remise, 0, ',', ' ') }}</td></tr>
    @endif
    <tr class="ttc"><td>TOTAL TTC (FCFA)</td><td class="text-end">{{ number_format($facture->grand_total, 0, ',', ' ') }}</td></tr>
  </table>

  <p class="arrete">
    Arrêtée la présente facture à la somme de :<br>
    <strong>{{ $facture->montant_lettres ?: number_format($facture->grand_total, 0, ',', ' ') . ' francs CFA' }}</strong>
  </p>
  <p class="small mb-0"><strong>Conditions de règlement :</strong> {{ $facture->conditions ?: 'Selon accord avec le client.' }}</p>

  <div class="direction">LA DIRECTION</div>
  <div class="pied"><strong>DEL SARL – Fournisseur & Intégrateur de Solutions Techniques</strong><br>RCCM : Ma.Bko.2015.B.703 | NIF : 084123008N | Hamdallaye ACI 2000, Bamako – Mali</div>
</div>

{{-- <script>
// ===== DONNÉES (à remplacer par celles de votre application) =====
const facture = {
  societe: {
    nom: "DOUCOURÉ ÉQUIPEMENT ET LOGISTIQUE SARL",
    adresse: "Hamdallaye ACI 2000 – Bamako, Mali",
    tel: "Tél. : +223 94 34 77 57 / +223 66 75 63 29",
    email: "Email : delsarl15@gmail.com",
    pied: "<strong>DEL SARL – Fournisseur & Intégrateur de Solutions Techniques</strong><br>RCCM : Ma.Bko.2015.B.703 | NIF : 084123008N | Hamdallaye ACI 2000, Bamako – Mali"
  },
  numero: "FA-2026-001",
  client: "MINISTÈRE DE L'ADMINISTRATION TERRITORIALE ET DE LA DÉCENTRALISATION",
  commande: "Bon de commande n° BC-2026-0457 du 26/09/2026",
  date: "Bamako, le 02/10/2026",
  echeance: "02/11/2026",
  devise: "Franc CFA (XOF)",
  tauxTva: 18, // TVA en vigueur au Mali : 18 %
  reglement: "Virement bancaire ou chèque, à 30 jours à compter de la date de facture",
  lignes: [
    { designation: "Photocopieur CANON imageRUNNER 4745i", qte: 1, pu: 7445000 },
    { designation: "Photocopieur CANON imageRUNNER ADVANCE 6568i", qte: 1, pu: 13868750 },
    { designation: "Scanner HP ScanJet Pro N4600 fnw1", qte: 4, pu: 1362500 },
    { designation: "Stabilisateur 5KVA", qte: 1, pu: 222000 }
  ]
};

// ===== NOMBRE → LETTRES (français) =====
const U = ["zéro","un","deux","trois","quatre","cinq","six","sept","huit","neuf","dix","onze","douze","treize","quatorze","quinze","seize","dix-sept","dix-huit","dix-neuf"];
const D = ["","","vingt","trente","quarante","cinquante","soixante"];
function moins100(n, fin) {
  if (n < 20) return U[n];
  const d = Math.floor(n / 10), u = n % 10;
  if (d <= 6) return D[d] + (u === 1 ? " et un" : u ? "-" + U[u] : "");
  if (d === 7) return "soixante" + (u === 1 ? " et onze" : "-" + U[10 + u]);
  if (d === 8) return "quatre-vingt" + (u ? "-" + U[u] : (fin ? "s" : ""));
  return "quatre-vingt-" + U[10 + u];
}
function moins1000(n, fin) {
  const c = Math.floor(n / 100), r = n % 100;
  let s = "";
  if (c) s = (c > 1 ? U[c] + " " : "") + "cent" + (c > 1 && !r && fin ? "s" : "");
  if (r) s += (s ? " " : "") + moins100(r, fin);
  return s;
}
function enLettres(n) {
  if (n === 0) return "zéro";
  const md = Math.floor(n / 1e9), m = Math.floor(n % 1e9 / 1e6), k = Math.floor(n % 1e6 / 1e3), r = n % 1e3;
  const p = [];
  if (md) p.push(moins1000(md, true) + " milliard" + (md > 1 ? "s" : ""));
  if (m) p.push(moins1000(m, true) + " million" + (m > 1 ? "s" : ""));
  if (k) p.push(k === 1 ? "mille" : moins1000(k, false) + " mille");
  if (r) p.push(moins1000(r, true));
  return p.join(" ");
}

// ===== RENDU =====
const fmt = n => new Intl.NumberFormat("fr-FR").format(n).replace(/[\u202f\u00a0]/g, " ");
const $ = id => document.getElementById(id);

$("societe-nom").textContent = facture.societe.nom;
$("societe-adresse").textContent = facture.societe.adresse;
$("societe-tel").textContent = facture.societe.tel;
$("societe-email").textContent = facture.societe.email;
$("pied").innerHTML = facture.societe.pied;
$("numero").textContent = "N° " + facture.numero;
$("client").textContent = facture.client;
$("commande").textContent = facture.commande;
$("date").textContent = facture.date;
$("echeance").textContent = facture.echeance;
$("devise").textContent = facture.devise;
$("reglement").textContent = facture.reglement;

let ht = 0;
$("lignes").innerHTML = facture.lignes.map((l, i) => {
  const t = l.qte * l.pu; ht += t;
  return `<tr>
    <td>${i + 1}</td><td>${l.designation}</td>
    <td class="text-center">${l.qte}</td>
    <td class="text-end">${fmt(l.pu)}</td>
    <td class="text-end">${fmt(t)}</td>
  </tr>`;
}).join("");

const tva = Math.round(ht * facture.tauxTva / 100);
const ttc = ht + tva;
$("total-ht").textContent = fmt(ht);
$("tva-label").textContent = `TVA (${facture.tauxTva} %)`;
$("total-tva").textContent = fmt(tva);
$("total-ttc").textContent = fmt(ttc);

const lettres = enLettres(ttc);
$("total-lettres").textContent =
  lettres.charAt(0).toUpperCase() + lettres.slice(1) + ` (${fmt(ttc)}) francs CFA toutes taxes comprises.`;
</script> --}}
</body>
</html>
