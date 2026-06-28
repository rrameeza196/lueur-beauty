<?php
// index.php — Lueur Beauty
// Session started server-side only for admin. Shoppers are guests — no login needed.
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>lueur — clean colour cosmetics</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0;}
html{scroll-behavior:smooth;}
body{font-family:'Jost',sans-serif;color:#3D2C23;background:#F8F2EB;min-height:100vh;}
::selection{background:#E9C9BB;color:#3D2C23;}
input::placeholder,textarea::placeholder{color:#B6A48F;}
a{text-decoration:none;color:inherit;}
button{font-family:'Jost',sans-serif;cursor:pointer;}
img{display:block;max-width:100%;}
.view{display:none!important;}.view.active{display:block!important;}

/* ── ANNOUNCE ── */
.announce{background:#3D2C23;color:#F1E4D6;text-align:center;padding:11px 16px;font-size:12.5px;letter-spacing:.14em;text-transform:uppercase;font-weight:300;}

/* ── HEADER ── */
header{display:flex;align-items:center;justify-content:space-between;padding:22px 56px;border-bottom:1px solid #E8DBCC;position:sticky;top:0;background:rgba(248,242,235,.95);backdrop-filter:blur(12px);z-index:200;}
.nav-left{display:flex;gap:34px;flex:1;}
.nav-left button{background:none;border:none;font-family:'Jost',sans-serif;font-size:13px;letter-spacing:.1em;text-transform:uppercase;color:#3D2C23;cursor:pointer;transition:color .2s;}
.nav-left button:hover{color:#BE6E4E;}
.logo{font-family:'Cormorant Garamond',serif;font-size:30px;font-weight:500;letter-spacing:.18em;color:#3D2C23;text-transform:lowercase;cursor:pointer;border:none;background:none;}
.nav-right{display:flex;gap:20px;flex:1;justify-content:flex-end;align-items:center;}
.nav-right button{background:none;border:none;font-family:'Jost',sans-serif;font-size:13px;letter-spacing:.1em;text-transform:uppercase;color:#3D2C23;cursor:pointer;transition:color .2s;}
.nav-right button:hover{color:#BE6E4E;}
.bag-btn{display:flex;align-items:center;gap:7px;cursor:pointer;background:none;border:none;font-family:'Jost',sans-serif;font-size:13px;letter-spacing:.1em;text-transform:uppercase;color:#3D2C23;transition:color .2s;}
.bag-btn:hover{color:#BE6E4E;}
.bag-count{background:#BE6E4E;color:#fff;min-width:21px;height:21px;border-radius:11px;display:inline-flex;align-items:center;justify-content:center;font-size:11.5px;padding:0 6px;transition:transform .2s;}
.bag-count.pop{transform:scale(1.4);}

/* ── BUTTONS ── */
.btn-p{background:#BE6E4E;color:#fff;padding:16px 34px;font-size:13px;letter-spacing:.14em;text-transform:uppercase;border-radius:2px;border:none;cursor:pointer;transition:background .2s;}
.btn-p:hover{background:#A85C3C;}
.btn-p:disabled{opacity:.6;cursor:not-allowed;}
.btn-o{background:transparent;border:1px solid #C8B6A6;color:#3D2C23;padding:10px 20px;font-size:12px;letter-spacing:.12em;text-transform:uppercase;cursor:pointer;border-radius:2px;transition:all .2s;}
.btn-o:hover{background:#3D2C23;color:#F8F2EB;border-color:#3D2C23;}
.btn-d{background:#3D2C23;color:#F1E4D6;padding:16px 36px;font-size:13px;letter-spacing:.14em;text-transform:uppercase;border:none;border-radius:2px;cursor:pointer;transition:background .2s;}
.btn-d:hover{background:#2C1F18;}
.btn-l{background:#FBF1E7;color:#3D2C23;padding:15px 32px;font-size:13px;letter-spacing:.14em;text-transform:uppercase;border:none;border-radius:2px;cursor:pointer;transition:background .2s;}
.btn-l:hover{background:#fff;}
.btn-txt{color:#3D2C23;padding:16px 6px;font-size:13px;letter-spacing:.14em;text-transform:uppercase;border-bottom:1px solid #C8B6A6;cursor:pointer;background:none;border-top:none;border-left:none;border-right:none;transition:color .2s;}
.btn-txt:hover{color:#BE6E4E;}

/* ── SECTION ── */
.sec-lbl{font-size:12.5px;letter-spacing:.22em;text-transform:uppercase;color:#BE6E4E;display:block;}
.sec-h2{font-family:'Cormorant Garamond',serif;font-weight:500;font-size:clamp(32px,4vw,44px);margin-top:12px;}

/* ── HERO ── */
.hero{display:grid;grid-template-columns:1.05fr 1fr;min-height:560px;}
.hero-l{display:flex;flex-direction:column;justify-content:center;padding:72px 56px;background:#F0E4D8;}
.hero-ey{font-size:12.5px;letter-spacing:.22em;text-transform:uppercase;color:#BE6E4E;margin-bottom:22px;}
.hero-h1{font-family:'Cormorant Garamond',serif;font-weight:500;font-size:clamp(44px,6vw,74px);line-height:1.02;letter-spacing:-.01em;margin-bottom:24px;}
.hero-p{font-size:17px;line-height:1.7;color:#6E5A4C;max-width:430px;font-weight:300;margin-bottom:36px;}
.hero-btns{display:flex;gap:16px;flex-wrap:wrap;}
.hero-r{background:linear-gradient(160deg,rgba(190,110,78,.28),rgba(110,65,45,.42)),url('http://localhost:8080/uploads/hero.jpg') center/cover no-repeat,radial-gradient(120% 130% at 70% 20%,#E8B79E 0%,#D98C7A 34%,#BE6E4E 72%,#9E5536 100%);display:flex;align-items:flex-end;padding:34px;position:relative;}
.hero-r::after{content:'';position:absolute;inset:0;background:radial-gradient(60% 50% at 30% 78%,rgba(120,60,40,.25),transparent 70%);}
.hero-cap{position:relative;z-index:1;font-family:'Cormorant Garamond',serif;font-style:italic;font-size:26px;color:#FBEFE4;text-shadow:0 1px 10px rgba(70,35,20,.5);}

/* ── SLIDER ── */
.edits{padding:84px 56px 30px;}
.edits-hdr{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:38px;}
.edits-ttl{font-family:'Cormorant Garamond',serif;font-weight:500;font-size:38px;}
.arrows{display:flex;gap:12px;}
.arrow{width:46px;height:46px;border-radius:50%;border:1px solid #C8B6A6;background:transparent;color:#3D2C23;font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;}
.arrow:hover{background:#3D2C23;color:#F8F2EB;border-color:#3D2C23;}
.sl-outer{overflow:hidden;}
.sl-track{display:flex;gap:26px;transition:transform .4s cubic-bezier(.4,0,.2,1);}
.cat-tile{flex:0 0 300px;cursor:pointer;}
.cat-img{aspect-ratio:3/4;border-radius:3px;margin-bottom:14px;display:flex;align-items:flex-end;padding:18px;position:relative;overflow:hidden;}
.cat-bg{position:absolute;inset:0;background-size:cover;background-position:center;transition:transform .5s ease;}
.cat-tile:hover .cat-bg{transform:scale(1.05);}
.cat-ov{position:absolute;inset:0;background:linear-gradient(180deg,rgba(120,70,50,.1),rgba(80,45,30,.45));}
.cat-tag{position:relative;z-index:1;font-family:'Cormorant Garamond',serif;font-style:italic;font-size:20px;color:#FBEFE4;text-shadow:0 1px 8px rgba(80,40,20,.35);}
.cat-ft{display:flex;align-items:center;justify-content:space-between;}
.cat-nm{font-family:'Cormorant Garamond',serif;font-size:23px;font-weight:500;}
.cat-ct{color:#A89378;font-size:13px;}

/* ── PRODUCT CARD ── */
.pgrid{display:grid;grid-template-columns:repeat(4,1fr);gap:26px;}
.pcard{display:flex;flex-direction:column;}
.pswatch{aspect-ratio:1/1;border-radius:3px;margin-bottom:16px;position:relative;overflow:hidden;}
.pswatch-bg{position:absolute;inset:0;background-size:cover;background-position:center;transition:transform .5s ease;}
.pcard:hover .pswatch-bg{transform:scale(1.05);}
.sale-tag{position:absolute;top:14px;left:14px;background:#9E5536;color:#fff;font-size:10.5px;letter-spacing:.1em;text-transform:uppercase;padding:5px 9px;border-radius:2px;z-index:2;}
.pkind{font-size:11.5px;letter-spacing:.12em;text-transform:uppercase;color:#A89378;margin-bottom:6px;}
.pname{font-family:'Cormorant Garamond',serif;font-weight:500;font-size:22px;line-height:1.15;margin-bottom:8px;}
.pstars{display:flex;align-items:center;gap:7px;margin-bottom:10px;}
.stars{color:#BE6E4E;font-size:13px;letter-spacing:2px;}
.rct{color:#A89378;font-size:12px;}
.pprow{display:flex;align-items:baseline;gap:9px;margin-bottom:14px;}
.pp{font-size:16px;color:#3D2C23;}
.porig{font-size:13px;color:#B6A48F;text-decoration:line-through;}
.add-bag{margin-top:auto;background:transparent;color:#3D2C23;border:1px solid #C8B6A6;padding:13px;font-size:12px;letter-spacing:.14em;text-transform:uppercase;cursor:pointer;border-radius:2px;transition:all .2s;width:100%;}
.add-bag:hover{background:#3D2C23;color:#F8F2EB;}
.skel{background:linear-gradient(90deg,#EDE0D4 25%,#E2D2C0 50%,#EDE0D4 75%);background-size:400% 100%;animation:sk 1.4s infinite;border-radius:3px;}
@keyframes sk{from{background-position:100% 0}to{background-position:-100% 0}}

/* ── STORY ── */
.story{display:grid;grid-template-columns:1fr 1fr;min-height:480px;}
.story-img{background:linear-gradient(160deg,rgba(190,110,78,.22),rgba(110,65,45,.4)),url('https://images.unsplash.com/photo-1571781926291-c477ebfd024b?auto=format&fit=crop&w=1000&q=80') center/cover no-repeat;display:flex;align-items:flex-end;padding:34px;}
.story-cap{font-family:'Cormorant Garamond',serif;font-style:italic;font-size:24px;color:#FBEFE4;text-shadow:0 1px 10px rgba(70,35,20,.5);}
.story-txt{background:#BE6E4E;color:#FBF1E7;display:flex;flex-direction:column;justify-content:center;padding:80px 64px;}
.story-ey{font-size:12.5px;letter-spacing:.22em;text-transform:uppercase;color:#F3DCCB;margin-bottom:22px;}
.story-h2{font-family:'Cormorant Garamond',serif;font-weight:500;font-size:46px;line-height:1.08;margin-bottom:24px;}
.story-p{font-size:16.5px;line-height:1.75;color:#FAEEE3;max-width:430px;font-weight:300;margin-bottom:34px;}

/* ── SHADE ── */
.shade-sec{padding:84px 56px;text-align:center;background:#F0E4D8;}
.shade-h2{font-family:'Cormorant Garamond',serif;font-weight:500;font-size:44px;margin:14px 0 34px;}
.shade-dots{display:flex;gap:16px;justify-content:center;flex-wrap:wrap;margin-bottom:38px;}
.sdot{width:54px;height:54px;border-radius:50%;cursor:pointer;transition:transform .2s;}
.sdot:hover{transform:scale(1.12);}

/* ── TESTI ── */
.testi{padding:96px 56px;text-align:center;max-width:880px;margin:0 auto;}
.testi-stars{color:#BE6E4E;font-size:15px;letter-spacing:3px;}
.testi-q{font-family:'Cormorant Garamond',serif;font-weight:400;font-style:italic;font-size:34px;line-height:1.35;margin:24px 0 26px;}
.testi-by{font-size:13px;letter-spacing:.16em;text-transform:uppercase;color:#8A7261;}

/* ── NEWSLETTER ── */
.news{background:#F0E4D8;padding:78px 56px;text-align:center;}
.news-h2{font-family:'Cormorant Garamond',serif;font-weight:500;font-size:40px;margin-bottom:14px;}
.news-p{font-size:16px;color:#6E5A4C;font-weight:300;margin-bottom:30px;}
.news-form{display:flex;gap:12px;max-width:460px;margin:0 auto;}
.news-inp{flex:1;padding:15px 18px;border:1px solid #D3C2B0;background:#F8F2EB;font-family:'Jost',sans-serif;font-size:14px;color:#3D2C23;border-radius:2px;outline:none;}

/* ── SHOP PAGE ── */
.shop-hero{padding:60px 56px 30px;background:#F0E4D8;text-align:center;}
.shop-crumb{font-size:12px;letter-spacing:.16em;text-transform:uppercase;color:#A89378;}
.shop-title{font-family:'Cormorant Garamond',serif;font-weight:500;font-size:58px;margin:10px 0 8px;}
.shop-blurb{font-size:15.5px;color:#6E5A4C;font-weight:300;}
.shop-body{padding:48px 56px 90px;}
.shop-meta{display:flex;align-items:center;justify-content:space-between;margin-bottom:30px;}
.shop-cnt{font-size:13px;color:#8A7261;}
.empty-box{text-align:center;padding:80px 20px;border:1px dashed #D8C8B8;border-radius:4px;}
.empty-h{font-family:'Cormorant Garamond',serif;font-style:italic;font-size:28px;color:#8A7261;margin-bottom:10px;}
.empty-p{font-size:14.5px;color:#A89378;font-weight:300;}

/* ── CART DRAWER ── */
.cart-overlay{position:fixed;inset:0;background:rgba(61,44,35,.45);z-index:500;opacity:0;pointer-events:none;transition:opacity .3s;}
.cart-overlay.open{opacity:1;pointer-events:all;}
.cart-drawer{position:fixed;top:0;right:0;bottom:0;width:420px;max-width:95vw;background:#FFFDFA;z-index:501;display:flex;flex-direction:column;transform:translateX(100%);transition:transform .35s cubic-bezier(.4,0,.2,1);box-shadow:-8px 0 40px rgba(61,44,35,.15);}
.cart-drawer.open{transform:translateX(0);}
.cart-hdr{display:flex;align-items:center;justify-content:space-between;padding:22px 24px;border-bottom:1px solid #EDE1D2;}
.cart-ttl{font-family:'Cormorant Garamond',serif;font-size:26px;font-weight:500;}
.cart-x{background:none;border:none;font-size:22px;color:#8A7261;cursor:pointer;line-height:1;padding:0 4px;transition:color .2s;}
.cart-x:hover{color:#3D2C23;}
.cart-items{flex:1;overflow-y:auto;padding:8px 24px;}
.cart-empty-state{display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;text-align:center;padding:48px 24px;color:#A89378;}
.cart-empty-icon{font-size:52px;margin-bottom:18px;opacity:.35;}
.cart-empty-t{font-family:'Cormorant Garamond',serif;font-style:italic;font-size:24px;color:#8A7261;margin-bottom:8px;}
.cart-empty-p{font-size:13.5px;font-weight:300;}
.ci{display:flex;gap:14px;padding:16px 0;border-bottom:1px solid #F1E7DA;}
.ci-img{width:72px;height:72px;border-radius:3px;object-fit:cover;flex-shrink:0;background:#F0E4D8;}
.ci-info{flex:1;min-width:0;}
.ci-name{font-family:'Cormorant Garamond',serif;font-size:18px;font-weight:500;margin-bottom:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.ci-kind{font-size:11.5px;color:#A89378;text-transform:uppercase;letter-spacing:.1em;margin-bottom:8px;}
.ci-row{display:flex;align-items:center;justify-content:space-between;}
.qty-ctrl{display:flex;align-items:center;gap:10px;border:1px solid #D8C8B8;border-radius:2px;padding:6px 12px;}
.qty-btn{background:none;border:none;font-size:16px;color:#8A7261;cursor:pointer;padding:0;line-height:1;transition:color .2s;}
.qty-btn:hover{color:#BE6E4E;}
.qty-n{font-size:14px;font-weight:500;min-width:18px;text-align:center;}
.ci-price{font-size:15px;color:#3D2C23;}
.ci-remove{font-size:11px;color:#B6A48F;cursor:pointer;letter-spacing:.06em;text-transform:uppercase;margin-top:6px;display:inline-block;border-bottom:1px solid #D8C8B8;transition:color .2s;}
.ci-remove:hover{color:#9E5536;}
.cart-foot{padding:20px 24px;border-top:1px solid #EDE1D2;}
.cart-sub{display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;}
.cart-sub-l{font-size:13px;color:#8A7261;}
.cart-sub-v{font-size:18px;font-weight:500;}
.cart-note{font-size:12px;color:#A89378;margin-bottom:16px;}
.cart-cta{width:100%;background:#BE6E4E;color:#fff;border:none;padding:16px;font-size:13px;letter-spacing:.14em;text-transform:uppercase;cursor:pointer;border-radius:2px;transition:background .2s;}
.cart-cta:hover{background:#A85C3C;}

/* ── CHECKOUT ── */
.ck-pg{background:#F8F2EB;min-height:100vh;}
.ck-bar{display:flex;align-items:center;justify-content:space-between;padding:22px 56px;background:#FFFDFA;border-bottom:1px solid #E8DBCC;}
.ck-logo{font-family:'Cormorant Garamond',serif;font-size:28px;font-weight:500;letter-spacing:.18em;text-transform:lowercase;cursor:pointer;border:none;background:none;color:#3D2C23;}
.ck-body{max-width:1000px;margin:0 auto;padding:48px 24px;display:grid;grid-template-columns:1fr 360px;gap:32px;align-items:start;}
.ck-card{background:#FFFDFA;border:1px solid #E8DBCC;border-radius:4px;padding:32px;margin-bottom:16px;}
.ck-sec-h{font-family:'Cormorant Garamond',serif;font-weight:500;font-size:22px;margin-bottom:22px;}
.fl{display:block;font-size:11.5px;letter-spacing:.14em;text-transform:uppercase;color:#A89378;margin-bottom:7px;}
.fi{width:100%;padding:13px 15px;border:1px solid #D3C2B0;background:#FBF6F0;font-family:'Jost',sans-serif;font-size:14px;color:#3D2C23;border-radius:2px;outline:none;transition:border-color .2s;margin-bottom:16px;}
.fi:focus{border-color:#BE6E4E;}
.fgrid{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
.pay-opt{display:flex;align-items:center;gap:12px;padding:14px;border:1px solid #D3C2B0;border-radius:2px;margin-bottom:10px;cursor:pointer;transition:border-color .2s;}
.pay-opt.on{border-color:#BE6E4E;background:#FBF6F0;}
.pay-opt input{accent-color:#BE6E4E;}
.pay-opt label{font-size:14px;cursor:pointer;}
.sum-item{display:flex;gap:13px;padding:13px 0;border-bottom:1px solid #F1E7DA;}
.sum-img{width:56px;height:56px;border-radius:3px;object-fit:cover;background:#F0E4D8;flex-shrink:0;}
.sum-name{font-family:'Cormorant Garamond',serif;font-size:16px;font-weight:500;margin-bottom:2px;}
.sum-kind{font-size:11.5px;color:#A89378;text-transform:uppercase;letter-spacing:.08em;}
.sum-price{font-size:14px;margin-top:5px;}
.tot-rows{margin-top:14px;display:flex;flex-direction:column;gap:10px;}
.tot-row{display:flex;justify-content:space-between;font-size:13.5px;color:#6E5A4C;}
.tot-row.total{font-size:16px;color:#3D2C23;font-weight:500;padding-top:10px;border-top:1px solid #EDE1D2;margin-top:4px;}
.ck-btn{width:100%;background:#BE6E4E;color:#fff;border:none;padding:16px;font-size:13px;letter-spacing:.14em;text-transform:uppercase;cursor:pointer;border-radius:2px;transition:background .2s;margin-top:16px;}
.ck-btn:hover{background:#A85C3C;}
.ck-btn:disabled{opacity:.6;cursor:not-allowed;}

/* ── SUCCESS ── */
.succ-pg{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:40px;background:radial-gradient(130% 110% at 50% 0%,#F0E4D8 0%,#F8F2EB 60%);}
.succ-box{max-width:520px;width:100%;text-align:center;}
.succ-icon{width:72px;height:72px;border-radius:50%;background:#BE6E4E;color:#fff;font-size:32px;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;}
.succ-h1{font-family:'Cormorant Garamond',serif;font-weight:500;font-size:44px;margin-bottom:14px;}
.succ-p{font-size:15px;color:#6E5A4C;font-weight:300;line-height:1.7;margin-bottom:8px;}
.succ-badge{display:inline-block;background:#F0E4D8;color:#BE6E4E;font-size:13px;letter-spacing:.12em;text-transform:uppercase;padding:8px 18px;border-radius:2px;margin:16px 0 32px;}

/* ── ADMIN LOGIN ── */
.login-pg{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:40px;background:radial-gradient(130% 110% at 50% 0%,#F0E4D8 0%,#F8F2EB 60%);}
.login-box{width:100%;max-width:400px;}
.login-logo-w{text-align:center;margin-bottom:30px;}
.login-logo{font-family:'Cormorant Garamond',serif;font-size:38px;font-weight:500;letter-spacing:.18em;color:#3D2C23;text-transform:lowercase;cursor:pointer;border:none;background:none;}
.login-card{background:#FFFDFA;border:1px solid #E8DBCC;border-radius:4px;padding:42px 38px;box-shadow:0 18px 50px -28px rgba(120,80,50,.4);}
.login-h1{font-family:'Cormorant Garamond',serif;font-weight:500;font-size:32px;margin-bottom:6px;}
.login-sub{font-size:14px;color:#8A7261;font-weight:300;margin-bottom:26px;}
.login-err{background:#FBF0EE;border:1px solid #E0C4B6;color:#9E5536;padding:11px 14px;border-radius:2px;font-size:13px;margin-bottom:16px;display:none;}
.login-err.show{display:block;}
.back-w{text-align:center;margin-top:20px;}
.back-btn{font-size:13px;color:#8A7261;border-bottom:1px solid #D8C8B8;padding-bottom:2px;cursor:pointer;transition:color .2s;background:none;border-top:none;border-left:none;border-right:none;font-family:'Jost',sans-serif;}
.back-btn:hover{color:#3D2C23;}
.login-hint{text-align:center;font-size:12px;color:#A89378;margin-top:18px;font-weight:300;}

/* ── ADMIN ── */
.adm-pg{min-height:100vh;background:#F8F2EB;}
.adm-bar{display:flex;align-items:center;justify-content:space-between;padding:20px 48px;border-bottom:1px solid #E8DBCC;background:#FFFDFA;}
.adm-logo-r{display:flex;align-items:center;gap:14px;}
.adm-logo{font-family:'Cormorant Garamond',serif;font-size:26px;letter-spacing:.16em;text-transform:lowercase;cursor:pointer;border:none;background:none;color:#3D2C23;}
.adm-tag{font-size:11px;letter-spacing:.18em;text-transform:uppercase;color:#fff;background:#BE6E4E;padding:4px 10px;border-radius:2px;}
.adm-acts{display:flex;gap:12px;}
.adm-home-body{display:flex;align-items:center;justify-content:center;padding:60px 40px;background:radial-gradient(130% 110% at 50% 0%,#F0E4D8 0%,#F8F2EB 55%);min-height:calc(100vh - 70px);}
.adm-welcome{width:100%;max-width:820px;text-align:center;}
.adm-h1{font-family:'Cormorant Garamond',serif;font-weight:500;font-size:52px;margin-bottom:12px;}
.adm-sub{font-size:16px;color:#6E5A4C;font-weight:300;margin-bottom:36px;}
.adm-stats-row{display:flex;gap:16px;justify-content:center;margin-bottom:44px;flex-wrap:wrap;}
.stat-chip{background:#FFFDFA;border:1px solid #E8DBCC;border-radius:4px;padding:18px 28px;text-align:center;min-width:120px;}
.stat-n{font-family:'Cormorant Garamond',serif;font-size:36px;font-weight:500;color:#BE6E4E;}
.stat-l{font-size:11px;letter-spacing:.12em;text-transform:uppercase;color:#A89378;margin-top:4px;}
.adm-cards{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;}
.adm-card{background:#FFFDFA;border:1px solid #E8DBCC;border-radius:4px;padding:32px 20px;cursor:pointer;box-shadow:0 14px 40px -30px rgba(120,80,50,.5);transition:transform .2s,box-shadow .2s;text-align:center;}
.adm-card:hover{transform:translateY(-4px);box-shadow:0 22px 50px -28px rgba(120,80,50,.6);}
.adm-icon{width:50px;height:50px;border-radius:50%;background:#F0E4D8;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:22px;color:#BE6E4E;}
.adm-card-h{font-family:'Cormorant Garamond',serif;font-weight:500;font-size:21px;margin-bottom:6px;}
.adm-card-p{font-size:12px;color:#8A7261;font-weight:300;line-height:1.5;}
.adm-body{max-width:1000px;margin:0 auto;padding:48px;}
.adm-ph{font-family:'Cormorant Garamond',serif;font-weight:500;font-size:40px;margin-bottom:8px;}
.adm-ps{font-size:14.5px;color:#8A7261;font-weight:300;margin-bottom:22px;}
.srch-w{position:relative;margin-bottom:22px;}
.srch-icon{position:absolute;left:16px;top:50%;transform:translateY(-50%);color:#A89378;font-size:16px;pointer-events:none;}
.srch{width:100%;padding:13px 16px 13px 42px;border:1px solid #D3C2B0;background:#FFFDFA;font-family:'Jost',sans-serif;font-size:14px;color:#3D2C23;border-radius:2px;outline:none;}
.srch:focus{border-color:#BE6E4E;}
.tbl{background:#FFFDFA;border:1px solid #E8DBCC;border-radius:4px;overflow:hidden;}
.tbl-hd{display:grid;gap:16px;padding:14px 22px;border-bottom:1px solid #EDE1D2;font-size:11px;letter-spacing:.14em;text-transform:uppercase;color:#A89378;}
.tbl-hd.prods{grid-template-columns:64px 2fr 1fr 1fr 170px;}
.tbl-hd.ords{grid-template-columns:70px 1.8fr 80px 100px 130px 150px;}
.tbl-row{display:grid;gap:16px;padding:14px 22px;align-items:center;border-bottom:1px solid #F1E7DA;transition:background .15s;}
.tbl-row:last-child{border-bottom:none;}
.tbl-row:hover{background:#FBF6F0;}
.tbl-row.prods{grid-template-columns:64px 2fr 1fr 1fr 170px;}
.tbl-row.ords{grid-template-columns:70px 1.8fr 80px 100px 130px 150px;}
.tbl-thumb{width:64px;height:64px;border-radius:3px;background-size:cover;background-position:center;flex-shrink:0;}
.tbl-pname{font-family:'Cormorant Garamond',serif;font-size:18px;font-weight:500;}
.tbl-pkind{font-size:11.5px;color:#A89378;text-transform:uppercase;letter-spacing:.1em;}
.tbl-acts{display:flex;gap:8px;justify-content:flex-end;}
.btn-edit{background:transparent;border:1px solid #C8B6A6;color:#3D2C23;padding:7px 11px;font-family:'Jost',sans-serif;font-size:11px;letter-spacing:.1em;text-transform:uppercase;cursor:pointer;border-radius:2px;transition:all .2s;}
.btn-edit:hover{background:#3D2C23;color:#F8F2EB;}
.btn-del{background:transparent;border:1px solid #E0C4B6;color:#9E5536;padding:7px 11px;font-family:'Jost',sans-serif;font-size:11px;letter-spacing:.1em;text-transform:uppercase;cursor:pointer;border-radius:2px;transition:all .2s;}
.btn-del:hover{background:#9E5536;color:#fff;}
.no-res{padding:44px;text-align:center;color:#A89378;font-size:14.5px;font-weight:300;}
.s-badge{font-size:11px;letter-spacing:.08em;text-transform:uppercase;padding:4px 10px;border-radius:2px;font-weight:500;display:inline-block;}
.s-pending{background:#FBF0EE;color:#9E5536;}
.s-processing{background:#F0E4D8;color:#BE6E4E;}
.s-shipped{background:#EAF3F8;color:#2B6A8A;}
.s-delivered{background:#EAF5EA;color:#2E7D32;}
.s-cancelled{background:#F5EAEA;color:#B71C1C;}
.s-sel{padding:7px 10px;border:1px solid #D3C2B0;background:#FBF6F0;font-family:'Jost',sans-serif;font-size:12px;color:#3D2C23;border-radius:2px;outline:none;cursor:pointer;width:100%;}

/* ── ADMIN FORM ── */
.form-wrap{max-width:660px;margin:0 auto;padding:48px;}
.form-h1{font-family:'Cormorant Garamond',serif;font-weight:500;font-size:40px;margin-bottom:8px;}
.form-sub{font-size:14.5px;color:#8A7261;font-weight:300;margin-bottom:32px;}
.form-card{background:#FFFDFA;border:1px solid #E8DBCC;border-radius:4px;padding:36px;}
.fgrid2{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;}
.fsel{width:100%;padding:13px 15px;border:1px solid #D3C2B0;background:#FBF6F0;font-family:'Jost',sans-serif;font-size:14px;color:#3D2C23;border-radius:2px;outline:none;}
.shade-row{display:flex;gap:12px;margin-bottom:20px;}
.sp{width:40px;height:40px;border-radius:50%;cursor:pointer;transition:box-shadow .15s;}
.fta{width:100%;min-height:88px;padding:13px 15px;border:1px solid #D3C2B0;background:#FBF6F0;font-family:'Jost',sans-serif;font-size:14px;color:#3D2C23;border-radius:2px;outline:none;resize:vertical;margin-bottom:24px;}
.fta:focus{border-color:#BE6E4E;}
.form-acts{display:flex;gap:14px;}
.form-save{flex:1;background:#BE6E4E;color:#fff;border:none;padding:15px;font-size:13px;letter-spacing:.14em;text-transform:uppercase;cursor:pointer;border-radius:2px;transition:background .2s;}
.form-save:hover{background:#A85C3C;}
.form-save:disabled{opacity:.6;cursor:not-allowed;}
.form-cancel{background:transparent;color:#3D2C23;border:1px solid #C8B6A6;padding:15px 24px;font-size:13px;letter-spacing:.14em;text-transform:uppercase;cursor:pointer;border-radius:2px;transition:all .2s;}
.form-cancel:hover{background:#3D2C23;color:#F8F2EB;}
.upload-area{border:2px dashed #D3C2B0;border-radius:4px;padding:24px;text-align:center;margin-bottom:14px;cursor:pointer;position:relative;transition:border-color .2s;}
.upload-area:hover{border-color:#BE6E4E;}
.upload-area input[type=file]{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;}
.upload-p{font-size:13px;color:#A89378;font-weight:300;pointer-events:none;}
.upload-prev{width:100%;max-height:150px;object-fit:cover;border-radius:3px;margin-top:12px;}

/* ── FOOTER ── */
footer{background:#3D2C23;color:#E7D6C5;padding:64px 56px 40px;}
.foot-grid{display:grid;grid-template-columns:1.5fr 1fr 1fr 1fr;gap:40px;padding-bottom:48px;border-bottom:1px solid #5A463A;}
.foot-logo{font-family:'Cormorant Garamond',serif;font-size:30px;letter-spacing:.18em;margin-bottom:16px;}
.foot-desc{font-size:14px;line-height:1.7;color:#BCA792;font-weight:300;max-width:260px;}
.foot-head{font-size:12px;letter-spacing:.16em;text-transform:uppercase;color:#A8917C;margin-bottom:16px;}
.foot-links{display:flex;flex-direction:column;gap:11px;}
.foot-links button{background:none;border:none;font-family:'Jost',sans-serif;font-size:14px;font-weight:300;color:#E7D6C5;text-align:left;cursor:pointer;padding:0;transition:color .2s;}
.foot-links button:hover{color:#fff;}
.foot-bot{display:flex;justify-content:space-between;align-items:center;padding-top:26px;font-size:12.5px;color:#A8917C;font-weight:300;flex-wrap:wrap;gap:12px;}
.foot-soc{display:flex;gap:22px;}
.foot-soc a{color:#A8917C;transition:color .2s;}
.foot-soc a:hover{color:#fff;}

/* ── TOAST ── */
.toast-wrap{position:fixed;bottom:28px;right:28px;z-index:9999;display:flex;flex-direction:column;gap:10px;pointer-events:none;}
.toast{background:#3D2C23;color:#F1E4D6;padding:14px 22px;border-radius:3px;font-size:13px;font-weight:300;letter-spacing:.04em;box-shadow:0 8px 30px rgba(60,40,25,.3);animation:tin .3s ease;border-left:3px solid #BE6E4E;max-width:300px;}
.toast.err{border-left-color:#9E5536;}
@keyframes tin{from{opacity:0;transform:translateY(8px);}to{opacity:1;transform:none;}}

/* ── RESPONSIVE ── */
@media(max-width:1100px){
  header,footer,.hero-l,.edits,.shade-sec,.news,.testi,.shop-hero,.shop-body,.story-txt,.adm-bar,.adm-body,.form-wrap,.ck-bar{padding-left:32px;padding-right:32px;}
  .pgrid{grid-template-columns:repeat(2,1fr);}
  .foot-grid{grid-template-columns:1fr 1fr;gap:28px;}
  .ck-body{grid-template-columns:1fr;}
  .adm-cards{grid-template-columns:repeat(2,1fr);}
}
@media(max-width:768px){
  header{padding:16px 22px;}
  .nav-left{display:none;}
  .hero{grid-template-columns:1fr;}
  .hero-r{min-height:240px;}
  .hero-l{padding:48px 22px;}
  .hero-h1{font-size:42px;}
  .story{grid-template-columns:1fr;}
  .story-img{min-height:200px;}
  .story-txt{padding:48px 28px;}
  .adm-cards{grid-template-columns:1fr 1fr;}
  .tbl-hd.ords,.tbl-row.ords{grid-template-columns:60px 1fr 90px 110px;}
}
</style>
</head>
<body>

<!-- ══ STORE ══════════════════════════════════════ -->
<div id="vStore" class="view active">
  <div class="announce">Complimentary shipping on orders over $45 &nbsp;·&nbsp; 30-day glow guarantee</div>
  <header>
    <nav class="nav-left">
      <button onclick="goCat('Lips')">Lips</button>
      <button onclick="goCat('Eyes')">Eyes</button>
      <button onclick="goCat('Face')">Face</button>
      <button onclick="goCat('Skin')">Skin</button>
    </nav>
    <button class="logo" onclick="goHome()">lueur</button>
    <div class="nav-right">
      <button onclick="goAdminLogin()" style="color:#A89378;font-size:12px;">Admin</button>
      <button class="bag-btn" onclick="openCart()">
        Bag <span class="bag-count" id="bagCount">0</span>
      </button>
    </div>
  </header>

  <!-- HOME -->
  <div id="vHome" class="view active">
    <section class="hero">
      <div class="hero-l">
        <div class="hero-ey">Clean colour cosmetics</div>
        <h1 class="hero-h1">Your beauty,<br>in warm light.</h1>
        <p class="hero-p">Skin-loving formulas in soft, sun-washed shades. Made to melt into you — never on top of you.</p>
        <div class="hero-btns">
          <button class="btn-p" onclick="goCat('Lips')">Shop the collection</button>
          <button class="btn-txt">Find your shade</button>
        </div>
      </div>
       <div class="hero-r"></div>
    </section>
    <section class="edits">
      <div class="edits-hdr">
        <h2 class="edits-ttl">Shop by edit</h2>
        <div class="arrows">
          <button class="arrow" onclick="slide(-1)">←</button>
          <button class="arrow" onclick="slide(1)">→</button>
        </div>
      </div>
      <div class="sl-outer"><div class="sl-track" id="slTrack"></div></div>
    </section>
    <section style="padding:64px 56px 84px;">
      <div style="text-align:center;margin-bottom:46px;">
        <span class="sec-lbl">Most loved</span>
        <h2 class="sec-h2">Bestsellers</h2>
      </div>
      <div class="pgrid" id="bestsGrid">
        <div class="pcard"><div class="pswatch skel" style="aspect-ratio:1;"></div><div class="skel" style="height:12px;width:55%;margin:14px 0 8px;"></div><div class="skel" style="height:22px;margin-bottom:10px;"></div><div class="skel" style="height:42px;"></div></div>
        <div class="pcard"><div class="pswatch skel" style="aspect-ratio:1;"></div><div class="skel" style="height:12px;width:55%;margin:14px 0 8px;"></div><div class="skel" style="height:22px;margin-bottom:10px;"></div><div class="skel" style="height:42px;"></div></div>
        <div class="pcard"><div class="pswatch skel" style="aspect-ratio:1;"></div><div class="skel" style="height:12px;width:55%;margin:14px 0 8px;"></div><div class="skel" style="height:22px;margin-bottom:10px;"></div><div class="skel" style="height:42px;"></div></div>
        <div class="pcard"><div class="pswatch skel" style="aspect-ratio:1;"></div><div class="skel" style="height:12px;width:55%;margin:14px 0 8px;"></div><div class="skel" style="height:22px;margin-bottom:10px;"></div><div class="skel" style="height:42px;"></div></div>
      </div>
    </section>
    <section class="story">
      <div class="story-img"><span class="story-cap">made in small batches</span></div>
      <div class="story-txt">
        <div class="story-ey">Our promise</div>
        <h2 class="story-h2">Made clean,<br>worn soft.</h2>
        <p class="story-p">Every formula is vegan, cruelty-free, and built on skin-conditioning oils and butters. No parabens, no shortcuts — just colour that feels like nothing and looks like you.</p>
        <button class="btn-l">Read our story</button>
      </div>
    </section>
    <section class="shade-sec">
      <span class="sec-lbl">For every undertone</span>
      <h2 class="shade-h2">Find your perfect shade</h2>
      <div class="shade-dots">
        <div class="sdot" title="Petal"      style="background:#E9C9BB;box-shadow:0 0 0 1px #E5D8CA;"></div>
        <div class="sdot" title="Bisque"     style="background:#E2B59C;box-shadow:0 0 0 1px #E5D8CA;"></div>
        <div class="sdot" title="Terracotta" style="background:#C17A57;box-shadow:0 0 0 1px #E5D8CA;"></div>
        <div class="sdot" title="Sienna"     style="background:#A85C3C;box-shadow:0 0 0 1px #E5D8CA;"></div>
        <div class="sdot" title="Clay"       style="background:#8C5238;box-shadow:0 0 0 1px #E5D8CA;"></div>
        <div class="sdot" title="Cocoa"      style="background:#6B4329;box-shadow:0 0 0 1px #E5D8CA;"></div>
        <div class="sdot" title="Espresso"   style="background:#4A2E1E;box-shadow:0 0 0 1px #E5D8CA;"></div>
      </div>
      <button class="btn-d">Take the shade quiz</button>
    </section>
    <section class="testi">
      <div class="testi-stars">★★★★★</div>
      <blockquote class="testi-q">"The Petal lip oil is the only thing I've reordered three times. It feels like a treatment and looks like the prettiest flush."</blockquote>
      <div class="testi-by">Maya R. — verified buyer</div>
    </section>
    <section class="news">
      <h2 class="news-h2">Stay in the glow</h2>
      <p class="news-p">15% off your first order, plus early access to new shades.</p>
      <div class="news-form">
        <input type="email" class="news-inp" id="newsEmail" placeholder="Email address">
        <button class="btn-p" style="padding:15px 28px;" onclick="subscribeNews()">Subscribe</button>
      </div>
    </section>
  </div><!-- /vHome -->

  <!-- SHOP/CATEGORY -->
  <div id="vShop" class="view">
    <section class="shop-hero">
      <div class="shop-crumb" id="shopCrumb">Home · Lips</div>
      <h1 class="shop-title" id="shopTitle">Lips</h1>
      <p class="shop-blurb" id="shopBlurb">Colours that melt into your skin.</p>
    </section>
    <section class="shop-body">
      <div class="shop-meta">
        <span class="shop-cnt" id="shopCnt">Loading…</span>
        <span style="font-size:12px;letter-spacing:.14em;text-transform:uppercase;color:#A89378;">Sorted by · Most loved</span>
      </div>
      <div class="pgrid" id="shopGrid"></div>
      <div class="empty-box" id="shopEmpty" style="display:none;">
        <p class="empty-h">Coming soon to this edit.</p>
        <p class="empty-p">New shades are in the works — check back shortly.</p>
      </div>
    </section>
  </div>

  <footer>
    <div class="foot-grid">
      <div>
        <div class="foot-logo">lueur</div>
        <p class="foot-desc">Clean colour cosmetics in warm, wearable shades. Made in small batches with skin in mind.</p>
      </div>
      <div>
        <div class="foot-head">Shop</div>
        <div class="foot-links">
          <button onclick="goCat('Lips')">Lips</button>
          <button onclick="goCat('Eyes')">Eyes</button>
          <button onclick="goCat('Face')">Face</button>
          <button onclick="goCat('Skin')">Skin</button>
        </div>
      </div>
      <div>
        <div class="foot-head">About</div>
        <div class="foot-links">
          <button onclick="toast('Coming soon!')">Our story</button>
          <button onclick="toast('Coming soon!')">Ingredients</button>
          <button onclick="toast('Coming soon!')">Sustainability</button>
          <button onclick="goAdminLogin()">Admin login</button>
        </div>
      </div>
      <div>
        <div class="foot-head">Help</div>
        <div class="foot-links">
          <button onclick="toast('Coming soon!')">Shipping</button>
          <button onclick="toast('Coming soon!')">Returns</button>
          <button onclick="toast('Coming soon!')">Contact</button>
          <button onclick="toast('Coming soon!')">FAQ</button>
        </div>
      </div>
    </div>
    <div class="foot-bot">
      <span>© 2026 Lueur Beauty. All rights reserved.</span>
      <div class="foot-soc">
        <a href="#">Instagram</a><a href="#">TikTok</a><a href="#">Pinterest</a>
      </div>
    </div>
  </footer>
</div><!-- /vStore -->

<!-- ══ CART DRAWER ════════════════════════════════ -->
<div class="cart-overlay" id="cartOverlay" onclick="closeCart()"></div>
<div class="cart-drawer" id="cartDrawer">
  <div class="cart-hdr">
    <div class="cart-ttl">Your bag</div>
    <button class="cart-x" onclick="closeCart()">×</button>
  </div>
  <div class="cart-items" id="cartItems"></div>
  <div class="cart-foot" id="cartFoot" style="display:none;">
    <div class="cart-sub">
      <span class="cart-sub-l">Subtotal</span>
      <span class="cart-sub-v" id="cartSubtotal">$0.00</span>
    </div>
    <p class="cart-note">Shipping calculated at checkout</p>
    <button class="cart-cta" onclick="closeCart();goCheckout()">Checkout →</button>
  </div>
</div>

<!-- ══ CHECKOUT ═══════════════════════════════════ -->
<div id="vCheckout" class="view">
  <div class="ck-pg">
    <div class="ck-bar">
      <button class="ck-logo" onclick="goHome()">lueur</button>
      <button class="btn-o" onclick="openCart()">← Back to bag</button>
    </div>
    <div class="ck-body">
      <div>
        <div class="ck-card">
          <div class="ck-sec-h">Delivery information</div>
          <div class="fgrid" style="margin-bottom:0;">
            <div><label class="fl">First name</label><input class="fi" id="ckFname" placeholder="first name"></div>
            <div><label class="fl">Last name</label><input class="fi" id="ckLname" placeholder="last name"></div>
          </div>
          <label class="fl">Email address</label>
          <input class="fi" type="email" id="ckEmail" placeholder="you@email.com">
          <label class="fl">Phone number</label>
          <input class="fi" type="tel" id="ckPhone" placeholder="+92 300 0000000">
          <label class="fl">Street address</label>
          <input class="fi" id="ckAddr" placeholder="House #, Street, Area">
          <div class="fgrid" style="margin-bottom:0;">
            <div><label class="fl">City</label><input class="fi" id="ckCity" placeholder="Lahore"></div>
            <div><label class="fl">Postal code</label><input class="fi" id="ckZip" placeholder=""></div>
          </div>
          <label class="fl">Order notes (optional)</label>
          <input class="fi" id="ckNotes" placeholder="Any special instructions?" style="margin-bottom:0;">
        </div>
        <div class="ck-card">
          <div class="ck-sec-h">Payment method</div>
          <div class="pay-opt on" id="pay-cod" onclick="selPay('cod')">
            <input type="radio" name="pay" checked><label>💰 Cash on Delivery</label>
          </div>
          <div class="pay-opt" id="pay-card" onclick="selPay('card')">
            <input type="radio" name="pay"><label>💳 Credit / Debit Card</label>
          </div>
          <div class="pay-opt" id="pay-ep" onclick="selPay('easypaisa')">
            <input type="radio" name="pay"><label>📱 EasyPaisa / JazzCash</label>
          </div>
        </div>
      </div>
      <div>
        <div class="ck-card" style="position:sticky;top:24px;">
          <div class="ck-sec-h">Order summary</div>
          <div id="ckSumItems"></div>
          <div class="tot-rows">
            <div class="tot-row"><span>Subtotal</span><span id="ckSubtotal">$0.00</span></div>
            <div class="tot-row"><span>Shipping</span><span style="color:#BE6E4E;">Free</span></div>
            <div class="tot-row total"><span>Total</span><span id="ckTotal">$0.00</span></div>
          </div>
          <button class="ck-btn" id="ckBtn" onclick="placeOrder()">Place order</button>
          <p style="text-align:center;font-size:11.5px;color:#A89378;margin-top:12px;">🔒 Secure checkout</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ══ SUCCESS ════════════════════════════════════ -->
<div id="vSuccess" class="view">
  <div class="succ-pg">
    <div class="succ-box">
      <div class="succ-icon">✓</div>
      <h1 class="succ-h1">Order placed!</h1>
      <p class="succ-p">Thank you for your order. We'll get your glow to you as soon as possible.</p>
      <div class="succ-badge" id="succOrderId">Order #—</div>
      <button class="btn-p" onclick="goHome()">Continue shopping</button>
    </div>
  </div>
</div>

<!-- ══ ADMIN LOGIN ════════════════════════════════ -->
<div id="vAdminLogin" class="view">
  <div class="login-pg">
    <div class="login-box">
      <div class="login-logo-w">
        <button class="login-logo" onclick="goHome()">lueur</button>
      </div>
      <div class="login-card">
        <h1 class="login-h1">Admin sign in</h1>
        <p class="login-sub">Sign in to manage your storefront.</p>
        <div class="login-err" id="loginErr"></div>
        <label class="fl">Username</label>
        <input type="text" class="fi" id="loginUser" placeholder="username">
        <label class="fl">Password</label>
        <input type="password" class="fi" id="loginPass" placeholder="" style="margin-bottom:22px;" onkeydown="if(event.key==='Enter')submitLogin()">
        <button class="btn-p" style="width:100%;padding:15px;" id="loginBtn" onclick="submitLogin()">Enter dashboard</button>
        <div class="back-w">
          <button class="back-btn" onclick="goHome()">← Back to store</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ══ ADMIN HOME ══════════════════════════════════ -->
<div id="vAdminHome" class="view">
  <div class="adm-pg">
    <div class="adm-bar">
      <div class="adm-logo-r">
        <button class="adm-logo" onclick="goHome()">lueur</button>
        <span class="adm-tag">Admin</span>
      </div>
      <button class="btn-o" onclick="doAdminLogout()">Log out</button>
    </div>
    <div class="adm-home-body">
      <div class="adm-welcome">
        <h1 class="adm-h1">Welcome, <span id="admName">Admin</span></h1>
        <p class="adm-sub">What would you like to do today?</p>
        <div class="adm-stats-row">
          <div class="stat-chip"><div class="stat-n" id="stProds">—</div><div class="stat-l">Products</div></div>
          <div class="stat-chip"><div class="stat-n" id="stOrds">—</div><div class="stat-l">Orders</div></div>
          <div class="stat-chip"><div class="stat-n" id="stPend">—</div><div class="stat-l">Pending</div></div>
          <div class="stat-chip"><div class="stat-n" id="stRev">—</div><div class="stat-l">Revenue</div></div>
          <div class="stat-chip"><div class="stat-n" id="stLow">—</div><div class="stat-l">Low stock</div></div>
        </div>
        <div class="adm-cards">
          <div class="adm-card" onclick="startAdd()">
            <div class="adm-icon">＋</div>
            <h3 class="adm-card-h">Add product</h3>
            <p class="adm-card-p">Create a new shade.</p>
          </div>
          <div class="adm-card" onclick="goAdminProds()">
            <div class="adm-icon">✎</div>
            <h3 class="adm-card-h">Edit products</h3>
            <p class="adm-card-p">Update or remove items.</p>
          </div>
          <div class="adm-card" onclick="goAdminOrds()">
            <div class="adm-icon">📦</div>
            <h3 class="adm-card-h">Orders</h3>
            <p class="adm-card-p">View and manage orders.</p>
          </div>
          <div class="adm-card" onclick="goAdminProds()">
            <div class="adm-icon">⌕</div>
            <h3 class="adm-card-h">Search</h3>
            <p class="adm-card-p">Find a product quickly.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ══ ADMIN PRODUCTS ══════════════════════════════ -->
<div id="vAdminProds" class="view">
  <div class="adm-pg">
    <div class="adm-bar">
      <div class="adm-logo-r">
        <button class="adm-logo" onclick="goHome()">lueur</button>
        <span class="adm-tag">Admin</span>
      </div>
      <div class="adm-acts">
        <button class="btn-o" onclick="goAdminHome()">Dashboard</button>
        <button class="btn-o" onclick="goAdminOrds()">Orders</button>
        <button class="btn-p" onclick="startAdd()">+ Add product</button>
      </div>
    </div>
    <div class="adm-body">
      <h1 class="adm-ph">Manage products</h1>
      <p class="adm-ps" id="admProdSub">Loading…</p>
      <div class="srch-w">
        <span class="srch-icon">⌕</span>
        <input type="text" class="srch" id="srchInput" placeholder="Search by name or category…" oninput="renderProdTbl()">
      </div>
      <div class="tbl">
        <div class="tbl-hd prods"><span></span><span>Product</span><span>Category</span><span>Price</span><span></span></div>
        <div id="prodRows"></div>
      </div>
    </div>
  </div>
</div>

<!-- ══ ADMIN ORDERS ════════════════════════════════ -->
<div id="vAdminOrds" class="view">
  <div class="adm-pg">
    <div class="adm-bar">
      <div class="adm-logo-r">
        <button class="adm-logo" onclick="goHome()">lueur</button>
        <span class="adm-tag">Admin</span>
      </div>
      <div class="adm-acts">
        <button class="btn-o" onclick="goAdminHome()">Dashboard</button>
        <button class="btn-o" onclick="goAdminProds()">Products</button>
      </div>
    </div>
    <div class="adm-body">
      <h1 class="adm-ph">Orders</h1>
      <p class="adm-ps" id="admOrdSub">Loading…</p>
      <div class="tbl">
        <div class="tbl-hd ords"><span>Order</span><span>Customer</span><span>Items</span><span>Total</span><span>Status</span><span>Update</span></div>
        <div id="ordRows"></div>
      </div>
    </div>
  </div>
</div>

<!-- ══ ADMIN ADD/EDIT ══════════════════════════════ -->
<div id="vAdminAdd" class="view">
  <div class="adm-pg">
    <div class="adm-bar">
      <div class="adm-logo-r">
        <button class="adm-logo" onclick="goHome()">lueur</button>
        <span class="adm-tag">Admin</span>
      </div>
      <button class="btn-o" onclick="goAdminProds()">← All products</button>
    </div>
    <div class="form-wrap">
      <h1 class="form-h1" id="formTitle">Add a product</h1>
      <p class="form-sub" id="formSub">It will appear in your catalogue and on the storefront.</p>
      <div class="form-card">
        <label class="fl">Product name</label>
        <input type="text" class="fi" id="fName" placeholder="e.g. Velvet Matte Lipstick">
        <label class="fl">Kind / sub-label</label>
        <input type="text" class="fi" id="fKind" placeholder="e.g. Lip oil, Mascara, Skin tint">
        <div class="fgrid2">
          <div><label class="fl">Category</label><select class="fsel" id="fCat"><option>Lips</option><option>Eyes</option><option>Face</option><option>Skin</option><option>Cheeks</option></select></div>
          <div><label class="fl">Price ($)</label><input type="number" class="fi" id="fPrice" placeholder="28" style="margin-bottom:0;"></div>
        </div>
        <div class="fgrid2">
          <div><label class="fl">Original price (sale tag)</label><input type="number" class="fi" id="fOrig" placeholder="34" style="margin-bottom:0;"></div>
          <div><label class="fl">Stock quantity</label><input type="number" class="fi" id="fStock" placeholder="50" style="margin-bottom:0;"></div>
        </div>
        <label class="fl" style="margin-top:16px;">Product image</label>
        <div class="upload-area" id="uploadArea">
          <input type="file" id="imgFile" accept="image/*" onchange="handleImg(this)">
          <p class="upload-p">Click to upload (JPG, PNG, WEBP · max 5MB)<br><small style="color:#C8B6A6;pointer-events:none;">or paste a URL below</small></p>
          <img id="uploadPrev" class="upload-prev" style="display:none;">
        </div>
        <label class="fl">Or paste image URL</label>
        <input type="url" class="fi" id="fImg" placeholder="https://images.unsplash.com/…" oninput="prevUrl(this.value)">
        <label class="fl">Shade colour</label>
        <div class="shade-row" id="shadePicks"></div>
        <label class="fl">Description</label>
        <textarea class="fta" id="fDesc" placeholder="A short, lovely description…"></textarea>
        <div class="form-acts">
          <button class="form-save" id="formSaveBtn" onclick="saveProduct()">Save product</button>
          <button class="form-cancel" onclick="goAdminProds()">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- TOAST -->
<div class="toast-wrap" id="toastWrap"></div>

<script>
const API='api.php';
const CATS=[
  {name:'Lips',  tag:'warm flush',     count:'47 shades',img:'https://images.unsplash.com/photo-1586495777744-4413f21062fa?auto=format&fit=crop&w=600&q=80'},
  {name:'Eyes',  tag:'soft definition',count:'34 shades',img:'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?auto=format&fit=crop&w=600&q=80'},
  {name:'Face',  tag:'glow base',      count:'28 shades',img:'https://images.unsplash.com/photo-1571781926291-c477ebfd024b?auto=format&fit=crop&w=600&q=80'},
  {name:'Skin',  tag:'second skin',    count:'19 shades',img:'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=600&q=80'},
  {name:'Cheeks',tag:'sun-washed',     count:'22 shades',img:'https://images.unsplash.com/photo-1631214524020-7e18db9a8f92?auto=format&fit=crop&w=600&q=80'},
];
const BLURBS={Lips:'Colours that melt into your skin.',Eyes:'Soft definition, all day.',Face:'Complexion, perfected.',Skin:'Tints that feel like nothing.',Cheeks:'A flush of warm light.'};
const SHADES=[{name:'Petal',c:'#E9C9BB'},{name:'Bisque',c:'#E2B59C'},{name:'Terracotta',c:'#C17A57'},{name:'Sienna',c:'#A85C3C'},{name:'Clay',c:'#8C5238'},{name:'Cocoa',c:'#6B4329'}];
const ALL_VIEWS=['vStore','vCheckout','vSuccess','vAdminLogin','vAdminHome','vAdminProds','vAdminOrds','vAdminAdd'];

let S={catIdx:0,shopCat:'Lips',editingId:null,fShade:'#C17A57',pay:'cod',cart:[],adminProds:[],adminOrds:[],adminName:'Admin'};

// ── API ──────────────────────────────────────────
async function apiFetch(method,action,body=null,isForm=false){
  const o={method,credentials:'same-origin',headers:{}};
  if(body&&!isForm){o.headers['Content-Type']='application/json';o.body=JSON.stringify(body);}
  if(body&&isForm){o.body=body;}
  const r=await fetch(`${API}?action=${action}`,o);
  const d=await r.json().catch(()=>({}));
  return{ok:r.ok,data:d};
}

// ── VIEWS ────────────────────────────────────────
function showView(id){
  ALL_VIEWS.forEach(v=>{const e=document.getElementById(v);if(e)e.classList.remove('active');});
  const el=document.getElementById(id);if(el)el.classList.add('active');
  window.scrollTo(0,0);
}
function showSub(id){
  ['vHome','vShop'].forEach(v=>{const e=document.getElementById(v);if(e)e.classList.remove('active');});
  const el=document.getElementById(id);if(el)el.classList.add('active');
}
function goHome(){showView('vStore');showSub('vHome');}
function goCat(c){S.shopCat=c;showView('vStore');showSub('vShop');loadShop();}
function goCheckout(){buildCkSummary();showView('vCheckout');}
function goAdminLogin(){showView('vAdminLogin');}
function goAdminHome(){showView('vAdminHome');loadStats();}
function goAdminProds(){showView('vAdminProds');fetchProds();}
function goAdminOrds(){showView('vAdminOrds');fetchOrds();}

// ── ADMIN SESSION CHECK ───────────────────────────
async function checkAdmin(){
  const{ok,data}=await apiFetch('GET','admin_me');
  if(ok&&data.logged_in){
    S.adminName=data.name;
    // already on an admin page? refresh stats
    const active=document.querySelector('.view.active');
    if(active&&active.id==='vAdminHome')loadStats();
  }
}

// ── CART ─────────────────────────────────────────
function cartTotal(){return S.cart.reduce((s,i)=>s+i.price*i.qty,0);}
function cartQty(){return S.cart.reduce((s,i)=>s+i.qty,0);}
function updateBadge(){
  const el=document.getElementById('bagCount');
  el.textContent=cartQty();
  el.classList.add('pop');setTimeout(()=>el.classList.remove('pop'),300);
}
function addToCart(p){
  const ex=S.cart.find(i=>i.id===p.id);
  ex?ex.qty++:S.cart.push({...p,qty:1});
  updateBadge();renderCart();
  toast(p.name+' added to bag ✓');
}
function removeFromCart(id){S.cart=S.cart.filter(i=>i.id!==id);updateBadge();renderCart();}
function chQty(id,d){const i=S.cart.find(x=>x.id===id);if(i){i.qty=Math.max(1,i.qty+d);updateBadge();renderCart();}}
function openCart(){renderCart();document.getElementById('cartOverlay').classList.add('open');document.getElementById('cartDrawer').classList.add('open');document.body.style.overflow='hidden';}
function closeCart(){document.getElementById('cartOverlay').classList.remove('open');document.getElementById('cartDrawer').classList.remove('open');document.body.style.overflow='';}
function renderCart(){
  const el=document.getElementById('cartItems'),ft=document.getElementById('cartFoot');
  if(S.cart.length===0){
    el.innerHTML=`<div class="cart-empty-state"><div class="cart-empty-icon">🛍</div><div class="cart-empty-t">Your bag is empty</div><p class="cart-empty-p">Add something beautiful to get started.</p></div>`;
    ft.style.display='none';return;
  }
  ft.style.display='';
  el.innerHTML=S.cart.map(i=>`
    <div class="ci">
      <img class="ci-img" src="${i.image_url||''}" alt="${i.name}" onerror="this.style.background='#F0E4D8';this.removeAttribute('src')">
      <div class="ci-info">
        <div class="ci-name">${i.name}</div>
        <div class="ci-kind">${i.kind}</div>
        <div class="ci-row">
          <div class="qty-ctrl">
            <button class="qty-btn" onclick="chQty(${i.id},-1)">−</button>
            <span class="qty-n">${i.qty}</span>
            <button class="qty-btn" onclick="chQty(${i.id},1)">+</button>
          </div>
          <span class="ci-price">$${(i.price*i.qty).toFixed(2)}</span>
        </div>
        <span class="ci-remove" onclick="removeFromCart(${i.id})">Remove</span>
      </div>
    </div>`).join('');
  document.getElementById('cartSubtotal').textContent='$'+cartTotal().toFixed(2);
}

// ── CHECKOUT ─────────────────────────────────────
function selPay(v){
  S.pay=v;
  ['cod','card','ep'].forEach(k=>{
    const el=document.getElementById('pay-'+k);
    if(el){el.classList.toggle('on',k===v);el.querySelector('input').checked=(k===v);}
  });
}
function buildCkSummary(){
  document.getElementById('ckSumItems').innerHTML=S.cart.map(i=>`
    <div class="sum-item">
      <img class="sum-img" src="${i.image_url||''}" alt="${i.name}" onerror="this.style.background='#F0E4D8';this.removeAttribute('src')">
      <div style="flex:1">
        <div class="sum-name">${i.name}</div>
        <div class="sum-kind">${i.kind} · Qty ${i.qty}</div>
        <div class="sum-price">$${(i.price*i.qty).toFixed(2)}</div>
      </div>
    </div>`).join('');
  const t='$'+cartTotal().toFixed(2);
  document.getElementById('ckSubtotal').textContent=t;
  document.getElementById('ckTotal').textContent=t;
}
async function placeOrder(){
  const fname=document.getElementById('ckFname').value.trim();
  const lname=document.getElementById('ckLname').value.trim();
  const email=document.getElementById('ckEmail').value.trim();
  const phone=document.getElementById('ckPhone').value.trim();
  const addr=document.getElementById('ckAddr').value.trim();
  const city=document.getElementById('ckCity').value.trim();
  const notes=document.getElementById('ckNotes').value.trim();
  if(!fname||!email||!addr){toast('Please fill name, email and address.','err');return;}
  if(S.cart.length===0){toast('Your bag is empty.','err');return;}
  const btn=document.getElementById('ckBtn');
  btn.disabled=true;btn.textContent='Placing order…';
  const{ok,data}=await apiFetch('POST','order',{
    name:fname+' '+lname,email,phone,
    address:addr,city,payment:S.pay,notes,
    total:cartTotal(),
    items:S.cart.map(i=>({id:i.id,name:i.name,price:i.price,qty:i.qty,shade:''}))
  });
  btn.disabled=false;btn.textContent='Place order';
  if(!ok){toast(data.error||'Order failed, please try again.','err');return;}
  document.getElementById('succOrderId').textContent='Order #'+data.order_id;
  S.cart=[];updateBadge();renderCart();
  showView('vSuccess');
}

// ── PRODUCT CARDS ─────────────────────────────────
function pCard(p,rating=true){
  const sh=p.shade_hex||'#C17A57';
  const grad=`radial-gradient(130% 120% at 50% 28%,${sh} 0%,${sh}cc 34%,#E7D5C3 78%)`;
  const bg=p.image_url?`background-image:url('${p.image_url}');background-size:cover;background-position:center;`:'';
  const pData=JSON.stringify({id:p.id,name:p.name,kind:p.kind,price:p.price,image_url:p.image_url||'',shade_hex:sh});
  return`<div class="pcard">
    <div class="pswatch" style="background:${grad};">
      ${p.image_url?`<div class="pswatch-bg" style="${bg}"></div>`:''}
      ${p.on_sale?'<span class="sale-tag">Sale</span>':''}
    </div>
    <div class="pkind">${p.kind}</div>
    <div class="pname">${p.name}</div>
    ${rating?`<div class="pstars"><span class="stars">★★★★★</span><span class="rct">${p.reviews}</span></div>`:''}
    <div class="pprow">
      <span class="pp">$${p.price.toFixed(2)}</span>
      ${p.on_sale?`<span class="porig">$${p.original_price.toFixed(2)}</span>`:''}
    </div>
    <button class="add-bag" onclick='addToCart(${pData})'>Add to bag</button>
  </div>`;
}

// ── SLIDER ────────────────────────────────────────
function renderSlider(){
  document.getElementById('slTrack').innerHTML=CATS.map(c=>`
    <div class="cat-tile" onclick="goCat('${c.name}')">
      <div class="cat-img">
        <div class="cat-bg" style="background-image:url('${c.img}');"></div>
        <div class="cat-ov"></div>
        <span class="cat-tag">${c.tag}</span>
      </div>
      <div class="cat-ft">
        <span class="cat-nm">${c.name}</span>
        <span class="cat-ct">${c.count}</span>
      </div>
    </div>`).join('');
  applySlide();
}
function applySlide(){const t=document.getElementById('slTrack');if(t)t.style.transform=`translateX(-${S.catIdx*(300+26)}px)`;}
function slide(d){S.catIdx=Math.max(0,Math.min(CATS.length-3,S.catIdx+d));applySlide();}

// ── LOAD PRODUCTS ─────────────────────────────────
async function loadBests(){
  const{ok,data}=await apiFetch('GET','products');
  const g=document.getElementById('bestsGrid');
  if(!ok||!Array.isArray(data)){g.innerHTML='<p style="color:#A89378;grid-column:1/-1;text-align:center;padding:40px">Could not load products.</p>';return;}
  g.innerHTML=data.slice(0,4).map(p=>pCard(p)).join('');
}
async function loadShop(){
  const cat=S.shopCat;
  document.getElementById('shopCrumb').textContent=`Home · ${cat}`;
  document.getElementById('shopTitle').textContent=cat;
  document.getElementById('shopBlurb').textContent=BLURBS[cat]||'Explore the collection.';
  document.getElementById('shopCnt').textContent='Loading…';
  const g=document.getElementById('shopGrid'),em=document.getElementById('shopEmpty');
  g.innerHTML='';
  const{ok,data}=await apiFetch('GET',`products&category=${encodeURIComponent(cat)}`);
  if(!ok){g.innerHTML='<p style="color:#A89378;grid-column:1/-1;">Could not load products.</p>';return;}
  document.getElementById('shopCnt').textContent=`${data.length} product${data.length!==1?'s':''}`;
  if(data.length===0){g.style.display='none';em.style.display='block';return;}
  g.style.display='grid';em.style.display='none';
  g.innerHTML=data.map(p=>pCard(p,false)).join('');
}

// ── ADMIN AUTH ────────────────────────────────────
function clearErr(){const e=document.getElementById('loginErr');e.textContent='';e.classList.remove('show');}
function showErr(m){const e=document.getElementById('loginErr');e.textContent=m;e.classList.add('show');}
async function submitLogin(){
  clearErr();
  const u=document.getElementById('loginUser').value.trim();
  const p=document.getElementById('loginPass').value;
  if(!u||!p){showErr('Please enter username and password.');return;}
  const btn=document.getElementById('loginBtn');
  btn.disabled=true;btn.textContent='Signing in…';
  const{ok,data}=await apiFetch('POST','admin_login',{username:u,password:p});
  btn.disabled=false;btn.textContent='Enter dashboard';
  if(!ok){showErr(data.error||'Invalid username or password.');return;}
  S.adminName=data.name;
  document.getElementById('loginUser').value='';
  document.getElementById('loginPass').value='';
  goAdminHome();
  toast('Welcome back, '+data.name+'!');
}
async function doAdminLogout(){
  await apiFetch('POST','admin_logout');
  goHome();toast('Logged out.');
}

// ── ADMIN STATS ───────────────────────────────────
async function loadStats(){
  document.getElementById('admName').textContent=S.adminName;
  const{ok,data}=await apiFetch('GET','stats');
  if(!ok){toast('Could not load stats — make sure you are logged in.','err');return;}
  document.getElementById('stProds').textContent=data.total;
  document.getElementById('stOrds').textContent=data.orders;
  document.getElementById('stPend').textContent=data.pending;
  document.getElementById('stRev').textContent='$'+Number(data.revenue).toFixed(0);
  document.getElementById('stLow').textContent=data.low;
}

// ── ADMIN PRODUCTS ────────────────────────────────
async function fetchProds(){
  const{ok,data}=await apiFetch('GET','products');
  if(ok&&Array.isArray(data))S.adminProds=data;
  renderProdTbl();
}
function renderProdTbl(){
  const q=(document.getElementById('srchInput')?.value||'').toLowerCase();
  const rows=S.adminProds.filter(p=>p.name.toLowerCase().includes(q)||p.category.toLowerCase().includes(q)||p.kind.toLowerCase().includes(q));
  document.getElementById('admProdSub').textContent=`${S.adminProds.length} product${S.adminProds.length!==1?'s':''} in your catalogue.`;
  const el=document.getElementById('prodRows');if(!el)return;
  if(rows.length===0){el.innerHTML=`<div class="no-res">No products match "${q}".</div>`;return;}
  el.innerHTML=rows.map(p=>`
    <div class="tbl-row prods">
      <div class="tbl-thumb" style="background-color:${p.shade_hex};${p.image_url?`background-image:url('${p.image_url}');background-size:cover;background-position:center;`:''}"></div>
      <div><div class="tbl-pname">${p.name}</div><div class="tbl-pkind">${p.kind}</div></div>
      <span style="font-size:14px;color:#6E5A4C;">${p.category}</span>
      <span style="font-size:15px;">$${p.price.toFixed(2)}</span>
      <div class="tbl-acts">
        <button class="btn-edit" onclick="editProduct(${p.id})">Edit</button>
        <button class="btn-del"  onclick="delProduct(${p.id})">Delete</button>
      </div>
    </div>`).join('');
}
async function delProduct(id){
  if(!confirm('Delete this product?'))return;
  const{ok,data}=await apiFetch('DELETE',`product&id=${id}`);
  if(!ok){toast(data.error||'Delete failed.','err');return;}
  S.adminProds=S.adminProds.filter(p=>p.id!==id);
  renderProdTbl();loadBests();toast('Product removed.');
}

// ── ADMIN ORDERS ──────────────────────────────────
async function fetchOrds(){
  const{ok,data}=await apiFetch('GET','orders');
  if(ok&&Array.isArray(data))S.adminOrds=data;
  renderOrdTbl();
}
function renderOrdTbl(){
  const el=document.getElementById('ordRows');if(!el)return;
  document.getElementById('admOrdSub').textContent=`${S.adminOrds.length} order${S.adminOrds.length!==1?'s':''} total.`;
  if(S.adminOrds.length===0){el.innerHTML='<div class="no-res">No orders yet.</div>';return;}
  const opts=['pending','processing','shipped','delivered','cancelled'];
  el.innerHTML=S.adminOrds.map(o=>`
    <div class="tbl-row ords">
      <span style="font-weight:500;font-size:14px;">#${o.id}</span>
      <div>
        <div style="font-size:14px;font-weight:500;">${o.user_name}</div>
        <div style="font-size:12px;color:#A89378;">${o.user_email}</div>
      </div>
      <span style="font-size:13px;color:#6E5A4C;">${o.item_count}</span>
      <span style="font-size:14px;">$${Number(o.total).toFixed(2)}</span>
      <span class="s-badge s-${o.status}">${o.status}</span>
      <select class="s-sel" onchange="updOrdStatus(${o.id},this.value)">
        ${opts.map(s=>`<option value="${s}"${s===o.status?' selected':''}>${s}</option>`).join('')}
      </select>
    </div>`).join('');
}
async function updOrdStatus(id,status){
  const{ok,data}=await apiFetch('PUT',`order_status&id=${id}`,{status});
  if(!ok){toast(data.error||'Update failed.','err');return;}
  const o=S.adminOrds.find(x=>x.id===id);if(o)o.status=status;
  renderOrdTbl();toast('Status → '+status+' ✓');
}

// ── ADMIN FORM ────────────────────────────────────
function startAdd(){
  S.editingId=null;S.fShade='#C17A57';
  ['fName','fKind','fPrice','fOrig','fStock','fImg','fDesc'].forEach(id=>{const e=document.getElementById(id);if(e)e.value='';});
  document.getElementById('fCat').value='Lips';
  resetPrev();renderShades();
  document.getElementById('formTitle').textContent='Add a product';
  document.getElementById('formSub').textContent='It will appear in your catalogue and on the storefront.';
  document.getElementById('formSaveBtn').textContent='Save product';
  goAdminAdd();
}
function editProduct(id){
  const p=S.adminProds.find(x=>x.id===id);if(!p)return;
  S.editingId=id;S.fShade=p.shade_hex;
  document.getElementById('fName').value=p.name;
  document.getElementById('fKind').value=p.kind;
  document.getElementById('fCat').value=p.category;
  document.getElementById('fPrice').value=p.price;
  document.getElementById('fOrig').value=p.original_price;
  document.getElementById('fStock').value=p.stock;
  document.getElementById('fImg').value=p.image_url;
  document.getElementById('fDesc').value=p.desc||'';
  prevUrl(p.image_url);renderShades();
  document.getElementById('formTitle').textContent='Edit product';
  document.getElementById('formSub').textContent='Update the details and save your changes.';
  document.getElementById('formSaveBtn').textContent='Update product';
  goAdminAdd();
}
function goAdminAdd(){showView('vAdminAdd');}
function renderShades(){
  document.getElementById('shadePicks').innerHTML=SHADES.map(s=>{
    const on=S.fShade===s.c;
    return`<div class="sp" title="${s.name}" style="background:${s.c};box-shadow:${on?'0 0 0 2px #FFFDFA,0 0 0 4px #BE6E4E':'0 0 0 1px #E5D8CA'};" onclick="pickShade('${s.c}')"></div>`;
  }).join('');
}
function pickShade(c){S.fShade=c;renderShades();}
function prevUrl(url){const p=document.getElementById('uploadPrev');if(url){p.src=url;p.style.display='block';}else{p.style.display='none';}}
function resetPrev(){const p=document.getElementById('uploadPrev');p.style.display='none';p.src='';document.getElementById('imgFile').value='';}
async function handleImg(input){
  const file=input.files[0];if(!file)return;
  const p=document.getElementById('uploadPrev');p.src=URL.createObjectURL(file);p.style.display='block';
  const fd=new FormData();fd.append('image',file);
  const{ok,data}=await apiFetch('POST','upload',fd,true);
  if(!ok){toast(data.error||'Upload failed.','err');return;}
  document.getElementById('fImg').value='http://localhost:8080'+data.url;
  toast('Image uploaded ✓');
}
async function saveProduct(){
  const name=document.getElementById('fName').value.trim();
  const kind=document.getElementById('fKind').value.trim();
  const cat=document.getElementById('fCat').value;
  const price=parseFloat(document.getElementById('fPrice').value)||0;
  const orig=parseFloat(document.getElementById('fOrig').value)||price;
  const stock=parseInt(document.getElementById('fStock').value)||0;
  const img=document.getElementById('fImg').value.trim();
  const desc=document.getElementById('fDesc').value.trim();
  if(!name){toast('Product name is required.','err');return;}
  if(price<=0){toast('Enter a valid price.','err');return;}
  const payload={name,kind,category:cat,price,original_price:orig,stock,shade_hex:S.fShade,image_url:img,description:desc};
  const btn=document.getElementById('formSaveBtn');
  btn.disabled=true;btn.textContent='Saving…';
  const{ok,data}=S.editingId
    ?await apiFetch('PUT',`product&id=${S.editingId}`,payload)
    :await apiFetch('POST','product',payload);
  btn.disabled=false;btn.textContent=S.editingId?'Update product':'Save product';
  if(!ok){toast(data.error||'Save failed.','err');return;}
  toast(S.editingId?'Product updated ✓':'Product added ✓');
  await fetchProds();goAdminProds();loadBests();
}

// ── NEWSLETTER ────────────────────────────────────
function subscribeNews(){
  const v=document.getElementById('newsEmail').value.trim();
  if(!v||!v.includes('@')){toast('Please enter a valid email.','err');return;}
  document.getElementById('newsEmail').value='';
  toast("You're subscribed — check your inbox for 15% off ✓");
}

// ── TOAST ─────────────────────────────────────────
function toast(msg,type='ok'){
  const wrap=document.getElementById('toastWrap');
  const el=document.createElement('div');
  el.className='toast'+(type==='err'?' err':'');
  el.textContent=msg;wrap.appendChild(el);
  setTimeout(()=>{el.style.opacity='0';el.style.transition='opacity .3s';setTimeout(()=>el.remove(),350);},3400);
}

// ── INIT ──────────────────────────────────────────
document.addEventListener('DOMContentLoaded',async()=>{
  renderSlider();
  await checkAdmin();
  await loadBests();
});
</script>
</body>
</html>
