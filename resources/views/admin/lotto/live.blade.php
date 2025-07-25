<html lang="en"><head><script type="importmap">{"imports":{"2rDQN":"/roulette/Box2D.simd.dd31b167.wasm","8BShk":"/roulette/Box2D.simd.2fa02903.js","h7cmx":"/roulette/Box2D.b9b16b27.wasm","ilUZb":"/roulette/Box2D.a11658c7.js"}}</script><script async="" src="https://www.googletagmanager.com/gtag/js?id=G-5899C1DJM0"></script><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta http-equiv="X-UA-Compatible" content="ie=edge"><link rel="apple-touch-icon" sizes="57x57" href="/roulette/apple-icon-57x57.5ecd1650.png"><link rel="apple-touch-icon" sizes="60x60" href="/roulette/apple-icon-60x60.b46a75af.png"><link rel="apple-touch-icon" sizes="72x72" href="/roulette/apple-icon-72x72.4726ed35.png"><link rel="apple-touch-icon" sizes="76x76" href="/roulette/apple-icon-76x76.72dbc1e1.png"><link rel="apple-touch-icon" sizes="114x114" href="/roulette/apple-icon-114x114.6cefcd75.png"><link rel="apple-touch-icon" sizes="120x120" href="/roulette/apple-icon-120x120.462d8e84.png"><link rel="apple-touch-icon" sizes="144x144" href="/roulette/apple-icon-144x144.36ef70f8.png"><link rel="apple-touch-icon" sizes="152x152" href="/roulette/apple-icon-152x152.1f1d2b56.png"><link rel="apple-touch-icon" sizes="180x180" href="/roulette/apple-icon-180x180.33666671.png"><link rel="icon" type="image/png" sizes="192x192" href="/roulette/android-icon-192x192.6c0734fc.png"><link rel="icon" type="image/png" sizes="32x32" href="/roulette/favicon-32x32.b3414860.png"><link rel="icon" type="image/png" sizes="96x96" href="/roulette/favicon-96x96.b086bd80.png"><link rel="icon" type="image/png" sizes="16x16" href="/roulette/favicon-16x16.b88a3ef4.png"><link rel="manifest" href="/roulette/assets/manifest.webmanifest"><meta name="msapplication-TileColor" content="#ffffff"><meta name="msapplication-TileImage" content="/roulette/ms-icon-144x144.e402ee4a.png"><meta name="theme-color" content="#ffffff"><title>Marble Roulette</title><style lang="scss">*{box-sizing:border-box}canvas{width:100%;height:100%;position:fixed;inset:0}div.copyright{color:#fff;z-index:999;text-align:center;width:90%;font-size:12px;position:fixed;bottom:0;left:50%;transform:translate(-50%)}div.copyright a{color:#fff}#settings{z-index:999;visibility:visible;opacity:1;background:#666;border-radius:10px;min-width:50%;padding:10px;transition:visibility,opacity 1s linear;display:flex;position:fixed;bottom:1rem;left:1rem;&.hide{opacity:0;visibility:hidden}& h3{color:#fefefe;margin:0;padding:0;font-size:12pt}& textarea{background:#999;border:none;width:100%;min-height:5rem;font-size:14pt}& button{color:#fefefe;background:#222;border:none;border-radius:5px;padding:5px 10px;position:relative;overflow:hidden;&:active:after{content:"";background:#00000080;position:absolute;inset:0}}& .icon{vertical-align:middle;background:currentColor;width:25px;height:25px;display:inline-block;mask-position:50%;mask-size:contain;mask-repeat:no-repeat;&.play{mask-image:url(play.d2b98249.svg)}&.shuffle{mask-image:url(shuffle.e9e498cf.svg)}&.megaphone{mask-image:url(megaphone.da49dfc8.svg)}&.record{mask-image:url(record.c71c4728.svg)}&.map{mask-image:url(map.eb357c03.svg)}&.trophy{mask-image:url(trophy.50d1ba0a.svg)}&.bomb{mask-image:url(bomb.455f9b17.svg)}}& div.left{flex-grow:1;flex-shrink:1;order:1;& .actions{justify-content:stretch;align-items:center;gap:2px;display:flex;& div.sep{flex-grow:1}}}& div.right{flex-grow:0;flex-shrink:0;order:2;& div.row{align-items:center;height:35px;display:flex;& label{color:#fff;flex-grow:0;flex-shrink:0;width:150px;padding-left:1rem}}}& select{background:#999;border-radius:5px;width:100%;height:25px}& input[type=checkbox]{vertical-align:middle;width:0;height:25px;position:relative;&:before{content:"";background:#999;border-radius:25px;width:50px;height:25px;display:inline-block;position:absolute;top:0;left:0}&:after{content:"";background:#ccc;border-radius:25px;width:25px;height:25px;transition:transform .2s;position:absolute;top:0;left:0}&:checked:after{background:#fff;transform:translate(100%)}&:checked:before{content:"";background:#00baff}}& .btn-group{justify-content:stretch;display:flex;&>*{box-sizing:border-box;color:#fefefe;background:#999;border:none;border-radius:0;flex-grow:0;flex-shrink:0;justify-content:center;align-items:center;width:33%;height:25px;padding:0;display:flex;overflow:hidden;&:first-child{border-radius:10px 0 0 10px}&:last-child{border-radius:0 10px 10px 0}&.active:before{content:"";vertical-align:middle;background:#fff;width:15px;height:15px;display:inline-block;mask-image:url(check.7e390469.svg);mask-repeat:no-repeat}&.active{background:#333}}& input[type=number]{box-sizing:border-box;text-align:center}}}#notice{z-index:1001;color:#333;background:#ffffffe6;border-radius:30px;flex-direction:column;width:500px;max-width:90%;padding:10px;display:none;position:fixed;top:50%;left:50%;overflow:hidden;transform:translate(-50%,-50%);& h1{background-color:#fd0;border-bottom:1px solid #333;align-items:center;margin:-10px -10px 0;padding:10px 5px 10px .5em;display:flex;&:before{content:"";background-image:url(megaphone.da49dfc8.svg);background-size:contain;width:1em;height:1em;margin-right:.2em;display:inline-block}}& div.notice-body{padding:0 .5em}& div.notice-action{justify-content:end;display:flex;& button{color:#fefefe;background:#222;border:none;border-radius:20px;width:50%;height:50px;padding:5px 10px;position:relative;overflow:hidden;&:active:after{content:"";background:#00000080;position:absolute;inset:0}}}}#donate{z-index:999;visibility:visible;opacity:1;transition:visibility,opacity 1s linear;position:fixed;bottom:calc(160px + 1.5rem);left:1rem;&.hide{opacity:0;visibility:hidden}}@media screen and (width<=750px){#donate{bottom:2rem}#settings{opacity:1;visibility:visible;width:calc(100% - 2rem);min-width:0;max-width:100%;transition:visibility,opacity 1s linear;display:block;bottom:calc(2.5rem + 60px);overflow:hidden;&.hide{opacity:0;visibility:hidden}& div.right div.row{border-bottom:1px solid #555;height:auto;padding:.5rem 0;display:block;& label{width:100%;margin-bottom:.5rem;padding-left:0;display:block}& .icon{width:15px;height:15px}}}#notice{box-sizing:border-box;z-index:1001;color:#333;background:#ffffffe6;border-radius:4px;flex-direction:column;width:100%;max-width:100%;height:100%;padding:5px 10px;display:none;position:fixed;top:0;left:0;transform:none;& div.notice-body{flex-grow:1}}}div.toast{z-index:1000;background:#ccc;border-radius:4px;padding:8px;animation:.2s linear fade-in,.2s linear 1s reverse fade-in;position:fixed;bottom:10px;left:50%;overflow:hidden;transform:translate(-50%)}@keyframes fade-in{0%{opacity:0;transform:translate(-50%,100%)}to{opacity:1;transform:translate(-50%)}}</style></head><body>
<script type="module" src="/roulette/roulette.0ab8edf8.js"></script>
<script>function gtag(){dataLayer.push(arguments)}function getNames(){return document.querySelector("#in_names").value.trim().split(/[,\r\n]/g).map(e=>e.trim()).filter(e=>!!e)}function parseName(e){let t=/(\/\d+)/,n=/(\*\d+)/,o=t.test(e),i=n.test(e),a=/^\s*([^\/*]+)?/.exec(e)[1];return{name:a,weight:o?parseInt(t.exec(e)[1].replace("/","")):1,count:i?parseInt(n.exec(e)[1].replace("*","")):1}}function getReady(){let e=getNames();switch(window.roullete.setMarbles(e),ready=e.length>0,localStorage.setItem("mbr_names",e.join(",")),winnerType){case"first":setWinnerRank(1);break;case"last":setWinnerRank(window.roullete.getCount())}}function setWinnerRank(e){document.querySelector("#in_winningRank").value=e,window.options.winningRank=e-1,window.roullete.setWinningRank(window.options.winningRank),"first"===winnerType?(document.querySelector(".btn-first-winner").classList.toggle("active",!0),document.querySelector(".btn-last-winner").classList.toggle("active",!1),document.querySelector("#in_winningRank").classList.toggle("active",!1)):"last"===winnerType?(document.querySelector(".btn-first-winner").classList.toggle("active",!1),document.querySelector(".btn-last-winner").classList.toggle("active",!0),document.querySelector("#in_winningRank").classList.toggle("active",!1)):"custom"===winnerType&&(document.querySelector(".btn-first-winner").classList.toggle("active",!1),document.querySelector(".btn-last-winner").classList.toggle("active",!1),document.querySelector("#in_winningRank").classList.toggle("active",!0))}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","G-5899C1DJM0");let ready=!1,winnerType="first";function initialize(){if(!window.roullete||!window.roullete.isReady){console.log("does not loaded yet"),setTimeout(initialize,100);return}console.log("initializing start");let e=localStorage.getItem("mbr_names");e&&(document.querySelector("#in_names").value=e),document.querySelector("#in_names").addEventListener("input",()=>{getReady()}),document.querySelector("#in_names").addEventListener("blur",()=>{let e=getNames(),t=new Set,n={};e.forEach(e=>{let o=parseName(e),i=o.weight>1?`${o.name}/${o.weight}`:o.name;t.has(i)||(t.add(i),n[i]=0),n[i]+=o.count});let o=[];Object.keys(n).forEach(e=>{n[e]>1?o.push(`${e}*${n[e]}`):o.push(e)});let i=document.querySelector("#in_names").value,a=o.join(",");i!==a&&(document.querySelector("#in_names").value=a,getReady())}),document.querySelector("#btnShuffle").addEventListener("click",()=>{getReady()}),document.querySelector("#btnStart").addEventListener("click",()=>{ready&&(gtag&&gtag("event","start",{event_category:"roulette",event_label:"start",value:window.roullete.getCount()}),window.roullete.start(),document.querySelector("#settings").classList.add("hide"),document.querySelector("#donate").classList.add("hide"))}),document.querySelector("#chkAutoRecording").addEventListener("change",e=>{window.options.autoRecording=e.target.matches(":checked"),window.roullete.setAutoRecording(window.options.autoRecording)}),document.querySelector("#chkSkill").addEventListener("change",e=>{window.options.useSkills=e.target.matches(":checked"),window.roullete.setWinningRank(window.options.winningRank)}),document.querySelector("#in_winningRank").addEventListener("change",e=>{let t=parseInt(e.target.value,10);winnerType="custom",setWinnerRank(isNaN(t)?0:t)}),document.querySelector(".btn-last-winner").addEventListener("click",()=>{let e=window.roullete.getCount();winnerType="last",setWinnerRank(e)}),document.querySelector(".btn-first-winner").addEventListener("click",()=>{winnerType="first",setWinnerRank(1)}),document.querySelector("#btnShake").addEventListener("click",()=>{window.roullete.shake(),gtag("event","shake",{event_category:"roulette",event_label:"shake",value:1})}),window.roullete.addEventListener("goal",()=>{ready=!1,setTimeout(()=>{document.querySelector("#settings").classList.remove("hide"),document.querySelector("#donate").classList.remove("hide")},3e3)}),window.roullete.addEventListener("shakeAvailableChanged",e=>{document.querySelector("#inGame").classList.toggle("hide",!e.detail)}),window.roullete.addEventListener("message",e=>{var t=e.detail;let n=document.createElement("div");n.classList.add("toast"),n.innerHTML=t,window.translateElement&&(console.log("try to translate"),window.translateElement(n)),document.body.appendChild(n),setTimeout(()=>{document.body.removeChild(n)},1200)}),document.querySelector("#btnShuffle").click();let t=window.roullete.getMaps(),n=document.querySelector("#sltMap");t.forEach(e=>{let t=document.createElement("option");t.value=e.index,t.innerHTML=e.title,t.setAttribute("data-trans",""),window.translateElement(t),n.append(t)}),n.addEventListener("change",e=>{let t=e.target.value;window.roullete.setMap(t)});let o=()=>{let e=document.querySelector("span.bmc-btn-text");e?(console.log("donation button has been loaded"),e.setAttribute("data-trans",""),window.translateElement(e)):setTimeout(o,100)};setTimeout(o,100);let i="lastViewedNotification",a=()=>{console.log("openNotice"),document.querySelector("#notice").style.display="flex"};document.querySelector("#closeNotice").addEventListener("click",()=>{document.querySelector("#notice").style.display="none",localStorage.setItem(i,"1")}),document.querySelector("#btnNotice").addEventListener("click",()=>{a()});let l=localStorage.getItem(i);console.log("lastViewed",l),(null===l||1>Number(l))&&a()}document.addEventListener("DOMContentLoaded",()=>{initialize()});</script>
<div id="settings" class="settings">
  <div class="right">
    <div class="row">
      <label>
        <i class="icon map"></i>
        <span data-trans="">Map</span>
      </label>
      <select id="sltMap"><option value="0" data-trans="">Wheel of fortune</option><option value="1" data-trans="">BubblePop</option><option value="2" data-trans="">Pot of greed</option><option value="3" data-trans="">Into The Night (by item4)</option></select>
    </div>
    <div class="row">
      <label>
        <i class="icon record"></i>
        <span data-trans="">Recording</span>
      </label>
      <input type="checkbox" id="chkAutoRecording">
    </div>
    <div class="row">
      <label>
        <i class="icon trophy"></i>
        <span data-trans="">The winner is</span>
      </label>
      <div class="btn-group">
        <button class="active btn-first-winner btn-winner" data-trans="">First</button>
        <button class="btn-last-winner btn-winner" data-trans="">Last</button>
        <input type="number" id="in_winningRank" value="1" min="1">
      </div>
    </div>
    <div class="row">
      <label>
        <i class="bomb icon"></i>
        <span data-trans="">Using skills</span>
      </label>
      <input type="checkbox" id="chkSkill" checked="">
    </div>
  </div>
  <div class="left">
    <h3 data-trans="">Enter names below</h3>
    <textarea id="in_names" placeholder="Input names separated by commas or line feed here" data-trans="placeholder">짱구*5, 짱아*10, 봉미선*3</textarea>
    <div class="actions">
      <button id="btnNotice">
        <i class="icon megaphone"></i>
      </button>
      <div class="sep"></div>
      <button id="btnShuffle">
        <i class="icon shuffle"></i>
        <span data-trans="">Shuffle</span>
      </button>
      <button id="btnStart">
        <i class="icon play"></i>
        <span data-trans="">Start</span>
      </button>
    </div>
  </div>
</div>
<div id="donate">
  <script src="https://cdnjs.buymeacoffee.com/1.0.0/button.prod.min.js" data-name="bmc-button" data-slug="lazygyu" data-color="#FFDD00" data-emoji="" data-font="Comic" data-text="Buy me a coffee" data-outline-color="#000000" data-font-color="#000000" data-coffee-color="#ffffff"></script><style>.bmc-btn svg {
    height: 32px !important;
    margin-bottom: 0px !important;
    box-shadow: none !important;
    border: none !important;
    vertical-align: middle !important;
    transform: scale(0.9);
    flex-shrink: 0;
}

.bmc-btn {
    min-width: 210px;
    color: #000000;
    background-color: #FFDD00 !important;
    height: 60px;
    border-radius: 12px;
    font-size: 28px;
    font-weight: Normal;
    border: none;
    padding: 0px 24px;
    line-height: 27px;
    text-decoration: none !important;
    display: inline-flex !important;
    align-items: center;
    font-family: 'Comic Neue', cursive !important;
    -webkit-box-sizing: border-box !important;
    box-sizing: border-box !important;
}

.bmc-btn:hover, .bmc-btn:active, .bmc-btn:focus {
    text-decoration: none !important;
    cursor: pointer;
}

.bmc-btn-text {
   text-align: left;
   margin-left: 8px;
   display: inline-block;
   line-height: 0;
   width: 100%;
   flex-shrink: 0;
   font-family: [FONT] !important;
   white-space: nowrap;
}

.logo-outline {
    fill: #000000;
}

.logo-coffee {
    fill: #ffffff;
}</style><link href="https://fonts.googleapis.com/css?family=Comic+Neue&amp;display=swap" rel="stylesheet"><div class="bmc-btn-container"><a class="bmc-btn" target="_blank" href="https://buymeacoffee.com/lazygyu"><svg viewBox="0 0 884 1279" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M791.109 297.518L790.231 297.002L788.201 296.383C789.018 297.072 790.04 297.472 791.109 297.518Z" fill="#0D0C22"></path>
<path d="M803.896 388.891L802.916 389.166L803.896 388.891Z" fill="#0D0C22"></path>
<path d="M791.484 297.377C791.359 297.361 791.237 297.332 791.118 297.29C791.111 297.371 791.111 297.453 791.118 297.534C791.252 297.516 791.379 297.462 791.484 297.377Z" fill="#0D0C22"></path>
<path d="M791.113 297.529H791.244V297.447L791.113 297.529Z" fill="#0D0C22"></path>
<path d="M803.111 388.726L804.591 387.883L805.142 387.573L805.641 387.04C804.702 387.444 803.846 388.016 803.111 388.726Z" fill="#0D0C22"></path>
<path d="M793.669 299.515L792.223 298.138L791.243 297.605C791.77 298.535 792.641 299.221 793.669 299.515Z" fill="#0D0C22"></path>
<path d="M430.019 1186.18C428.864 1186.68 427.852 1187.46 427.076 1188.45L427.988 1187.87C428.608 1187.3 429.485 1186.63 430.019 1186.18Z" fill="#0D0C22"></path>
<path d="M641.187 1144.63C641.187 1143.33 640.551 1143.57 640.705 1148.21C640.705 1147.84 640.86 1147.46 640.929 1147.1C641.015 1146.27 641.084 1145.46 641.187 1144.63Z" fill="#0D0C22"></path>
<path d="M619.284 1186.18C618.129 1186.68 617.118 1187.46 616.342 1188.45L617.254 1187.87C617.873 1187.3 618.751 1186.63 619.284 1186.18Z" fill="#0D0C22"></path>
<path d="M281.304 1196.06C280.427 1195.3 279.354 1194.8 278.207 1194.61C279.136 1195.06 280.065 1195.51 280.684 1195.85L281.304 1196.06Z" fill="#0D0C22"></path>
<path d="M247.841 1164.01C247.704 1162.66 247.288 1161.35 246.619 1160.16C247.093 1161.39 247.489 1162.66 247.806 1163.94L247.841 1164.01Z" fill="#0D0C22"></path>
<path class="logo-coffee" d="M472.623 590.836C426.682 610.503 374.546 632.802 306.976 632.802C278.71 632.746 250.58 628.868 223.353 621.274L270.086 1101.08C271.74 1121.13 280.876 1139.83 295.679 1153.46C310.482 1167.09 329.87 1174.65 349.992 1174.65C349.992 1174.65 416.254 1178.09 438.365 1178.09C462.161 1178.09 533.516 1174.65 533.516 1174.65C553.636 1174.65 573.019 1167.08 587.819 1153.45C602.619 1139.82 611.752 1121.13 613.406 1101.08L663.459 570.876C641.091 563.237 618.516 558.161 593.068 558.161C549.054 558.144 513.591 573.303 472.623 590.836Z" fill="#FFDD00"></path>
<path d="M78.6885 386.132L79.4799 386.872L79.9962 387.182C79.5987 386.787 79.1603 386.435 78.6885 386.132Z" fill="#0D0C22"></path>
<path class="logo-outline" d="M879.567 341.849L872.53 306.352C866.215 274.503 851.882 244.409 819.19 232.898C808.711 229.215 796.821 227.633 788.786 220.01C780.751 212.388 778.376 200.55 776.518 189.572C773.076 169.423 769.842 149.257 766.314 129.143C763.269 111.85 760.86 92.4243 752.928 76.56C742.604 55.2584 721.182 42.8009 699.88 34.559C688.965 30.4844 677.826 27.0375 666.517 24.2352C613.297 10.1947 557.342 5.03277 502.591 2.09047C436.875 -1.53577 370.983 -0.443234 305.422 5.35968C256.625 9.79894 205.229 15.1674 158.858 32.0469C141.91 38.224 124.445 45.6399 111.558 58.7341C95.7448 74.8221 90.5829 99.7026 102.128 119.765C110.336 134.012 124.239 144.078 138.985 150.737C158.192 159.317 178.251 165.846 198.829 170.215C256.126 182.879 315.471 187.851 374.007 189.968C438.887 192.586 503.87 190.464 568.44 183.618C584.408 181.863 600.347 179.758 616.257 177.304C634.995 174.43 647.022 149.928 641.499 132.859C634.891 112.453 617.134 104.538 597.055 107.618C594.095 108.082 591.153 108.512 588.193 108.942L586.06 109.252C579.257 110.113 572.455 110.915 565.653 111.661C551.601 113.175 537.515 114.414 523.394 115.378C491.768 117.58 460.057 118.595 428.363 118.647C397.219 118.647 366.058 117.769 334.983 115.722C320.805 114.793 306.661 113.611 292.552 112.177C286.134 111.506 279.733 110.801 273.333 110.009L267.241 109.235L265.917 109.046L259.602 108.134C246.697 106.189 233.792 103.953 221.025 101.251C219.737 100.965 218.584 100.249 217.758 99.2193C216.932 98.1901 216.482 96.9099 216.482 95.5903C216.482 94.2706 216.932 92.9904 217.758 91.9612C218.584 90.9319 219.737 90.2152 221.025 89.9293H221.266C232.33 87.5721 243.479 85.5589 254.663 83.8038C258.392 83.2188 262.131 82.6453 265.882 82.0832H265.985C272.988 81.6186 280.026 80.3625 286.994 79.5366C347.624 73.2301 408.614 71.0801 469.538 73.1014C499.115 73.9618 528.676 75.6996 558.116 78.6935C564.448 79.3474 570.746 80.0357 577.043 80.8099C579.452 81.1025 581.878 81.4465 584.305 81.7391L589.191 82.4445C603.438 84.5667 617.61 87.1419 631.708 90.1703C652.597 94.7128 679.422 96.1925 688.713 119.077C691.673 126.338 693.015 134.408 694.649 142.03L696.732 151.752C696.786 151.926 696.826 152.105 696.852 152.285C701.773 175.227 706.7 198.169 711.632 221.111C711.994 222.806 712.002 224.557 711.657 226.255C711.312 227.954 710.621 229.562 709.626 230.982C708.632 232.401 707.355 233.6 705.877 234.504C704.398 235.408 702.75 235.997 701.033 236.236H700.895L697.884 236.649L694.908 237.044C685.478 238.272 676.038 239.419 666.586 240.486C647.968 242.608 629.322 244.443 610.648 245.992C573.539 249.077 536.356 251.102 499.098 252.066C480.114 252.57 461.135 252.806 442.162 252.771C366.643 252.712 291.189 248.322 216.173 239.625C208.051 238.662 199.93 237.629 191.808 236.58C198.106 237.389 187.231 235.96 185.029 235.651C179.867 234.928 174.705 234.177 169.543 233.397C152.216 230.798 134.993 227.598 117.7 224.793C96.7944 221.352 76.8005 223.073 57.8906 233.397C42.3685 241.891 29.8055 254.916 21.8776 270.735C13.7217 287.597 11.2956 305.956 7.64786 324.075C4.00009 342.193 -1.67805 361.688 0.472751 380.288C5.10128 420.431 33.165 453.054 73.5313 460.35C111.506 467.232 149.687 472.807 187.971 477.556C338.361 495.975 490.294 498.178 641.155 484.129C653.44 482.982 665.708 481.732 677.959 480.378C681.786 479.958 685.658 480.398 689.292 481.668C692.926 482.938 696.23 485.005 698.962 487.717C701.694 490.429 703.784 493.718 705.08 497.342C706.377 500.967 706.846 504.836 706.453 508.665L702.633 545.797C694.936 620.828 687.239 695.854 679.542 770.874C671.513 849.657 663.431 928.434 655.298 1007.2C653.004 1029.39 650.71 1051.57 648.416 1073.74C646.213 1095.58 645.904 1118.1 641.757 1139.68C635.218 1173.61 612.248 1194.45 578.73 1202.07C548.022 1209.06 516.652 1212.73 485.161 1213.01C450.249 1213.2 415.355 1211.65 380.443 1211.84C343.173 1212.05 297.525 1208.61 268.756 1180.87C243.479 1156.51 239.986 1118.36 236.545 1085.37C231.957 1041.7 227.409 998.039 222.9 954.381L197.607 711.615L181.244 554.538C180.968 551.94 180.693 549.376 180.435 546.76C178.473 528.023 165.207 509.681 144.301 510.627C126.407 511.418 106.069 526.629 108.168 546.76L120.298 663.214L145.385 904.104C152.532 972.528 159.661 1040.96 166.773 1109.41C168.15 1122.52 169.44 1135.67 170.885 1148.78C178.749 1220.43 233.465 1259.04 301.224 1269.91C340.799 1276.28 381.337 1277.59 421.497 1278.24C472.979 1279.07 524.977 1281.05 575.615 1271.72C650.653 1257.95 706.952 1207.85 714.987 1130.13C717.282 1107.69 719.576 1085.25 721.87 1062.8C729.498 988.559 737.115 914.313 744.72 840.061L769.601 597.451L781.009 486.263C781.577 480.749 783.905 475.565 787.649 471.478C791.392 467.391 796.352 464.617 801.794 463.567C823.25 459.386 843.761 452.245 859.023 435.916C883.318 409.918 888.153 376.021 879.567 341.849ZM72.4301 365.835C72.757 365.68 72.1548 368.484 71.8967 369.792C71.8451 367.813 71.9483 366.058 72.4301 365.835ZM74.5121 381.94C74.6842 381.819 75.2003 382.508 75.7337 383.334C74.925 382.576 74.4089 382.009 74.4949 381.94H74.5121ZM76.5597 384.641C77.2996 385.897 77.6953 386.689 76.5597 384.641V384.641ZM80.672 387.979H80.7752C80.7752 388.1 80.9645 388.22 81.0333 388.341C80.9192 388.208 80.7925 388.087 80.6548 387.979H80.672ZM800.796 382.989C793.088 390.319 781.473 393.726 769.996 395.43C641.292 414.529 510.713 424.199 380.597 419.932C287.476 416.749 195.336 406.407 103.144 393.382C94.1102 392.109 84.3197 390.457 78.1082 383.798C66.4078 371.237 72.1548 345.944 75.2003 330.768C77.9878 316.865 83.3218 298.334 99.8572 296.355C125.667 293.327 155.64 304.218 181.175 308.09C211.917 312.781 242.774 316.538 273.745 319.36C405.925 331.405 540.325 329.529 671.92 311.91C695.906 308.686 719.805 304.941 743.619 300.674C764.835 296.871 788.356 289.731 801.175 311.703C809.967 326.673 811.137 346.701 809.778 363.615C809.359 370.984 806.139 377.915 800.779 382.989H800.796Z" fill="#0D0C22"></path>
</svg>


</div>
<div id="inGame" class="hide settings">
  <button id="btnShake" data-trans="">Shake!</button>
</div>
<div id="notice">
  <h1>Notice</h1>
  <div class="notice-body">
    <p>이 프로그램은 무료이며 사용에 아무런 제한이 없습니다.</p>
    <p>이 프로그램의 사용이나 프로그램을 이용한 영상 제작, 방송 등에 원작자는 아무런 제재를 가하거나 이의를 제기하지 않습니다. 자유롭게 사용하셔도 됩니다.</p>
    <p>다만 저작권자를 사칭하는 것은 저작권법을 위반하는 범죄입니다.</p>
    <p>저작권자를 사칭하여 권리 침해를 주장하는 경우를 보거나 겪으시는 분은 <a href="mailto:lazygyu+legal@gmail.com" target="_blank">lazygyu+legal@gmail.com</a>
      으로 제보 부탁드립니다.</p>
    <p>감사합니다.</p>
  </div>
  <div class="notice-action">
    <button id="closeNotice" data-trans="">Close</button>
  </div>
</div>


<canvas width="640" height="477"></canvas></body></html>