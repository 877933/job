<?php
// Get fonts files
$cs_fonts_vars = array('fonts');
$cs_fonts_vars = CS_JOBCAREER_GLOBALS()->globalizing($cs_fonts_vars);
extract($cs_fonts_vars);

$fonts = '{
 "kind": "webfonts#webfontList",
 "items": [
  {
   "kind": "webfonts#webfont",
   "family": "ABeeZee",
   "category": "sans-serif",
   "variants": [
    "regular",
    "italic"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/abeezee/v4/mE5BOuZKGln_Ex0uYKpIaw.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/abeezee/v4/kpplLynmYgP0YtlJA3atRw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Abel",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/abel/v6/RpUKfqNxoyNe_ka23bzQ2A.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Abril Fatface",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v8",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/abrilfatface/v8/X1g_KwGeBV3ajZIXQ9VnDojjx0o0jr6fNXxPgYh_a8Q.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Aclonica",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/aclonica/v6/M6pHZMPwK3DiBSlo3jwAKQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Acme",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/acme/v5/-J6XNtAHPZBEbsifCdBt-g.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Actor",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/actor/v6/ugMf40CrRK6Jf6Yz_xNSmQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Adamina",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/adamina/v7/RUQfOodOMiVVYqFZcSlT9w.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Advent Pro",
   "category": "sans-serif",
   "variants": [
    "100",
    "200",
    "300",
    "regular",
    "500",
    "600",
    "700"
   ],
   "subsets": [
    "greek",
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "100": "'.cs_server_protocol().'fonts.gstatic.com/s/adventpro/v4/87-JOpSUecTG50PBYK4ysi3USBnSvpkopQaUR-2r7iU.ttf",
    "200": "'.cs_server_protocol().'fonts.gstatic.com/s/adventpro/v4/URTSSjIp0Wr-GrjxFdFWnGeudeTO44zf-ht3k-KNzwg.ttf",
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/adventpro/v4/sJaBfJYSFgoB80OL1_66m0eOrDcLawS7-ssYqLr2Xp4.ttf",
    "500": "'.cs_server_protocol().'fonts.gstatic.com/s/adventpro/v4/7kBth2-rT8tP40RmMMXMLJp-63r6doWhTEbsfBIRJ7A.ttf",
    "600": "'.cs_server_protocol().'fonts.gstatic.com/s/adventpro/v4/3Jo-2maCzv2QLzQBzaKHV_pTEJqju4Hz1txDWij77d4.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/adventpro/v4/M4I6QiICt-ey_wZTpR2gKwJKKGfqHaYFsRG-T3ceEVo.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/adventpro/v4/1NxMBeKVcNNH2H46AUR3wfesZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Aguafina Script",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/aguafinascript/v5/65g7cgMtMGnNlNyq_Z6CvMxLhO8OSNnfAp53LK1_iRs.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Akronim",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/akronim/v5/qA0L2CSArk3tuOWE1AR1DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Aladin",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/aladin/v5/PyuJ5cVHkduO0j5fAMKvAA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Aldrich",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/aldrich/v6/kMMW1S56gFx7RP_mW1g-Eg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Alef",
   "category": "sans-serif",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "hebrew",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-08",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/alef/v5/VDgZJhEwudtOzOFQpZ8MEA.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/alef/v5/ENvZ_P0HBDQxNZYCQO0lUA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Alegreya",
   "category": "serif",
   "variants": [
    "regular",
    "italic",
    "700",
    "700italic",
    "900",
    "900italic"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreya/v7/5oZtdI5-wQwgAFrd9erCsaCWcynf_cDxXwCLxiixG1c.ttf",
    "900": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreya/v7/oQeMxX-vxGImzDgX6nxA7KCWcynf_cDxXwCLxiixG1c.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreya/v7/62J3atXd6bvMU4qO_ca-eA.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreya/v7/cbshnQGxwmlHBjUil7DaIfesZW2xOQ-xsNqO47m55DA.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreya/v7/IWi8e5bpnqhMRsZKTcTUWgJKKGfqHaYFsRG-T3ceEVo.ttf",
    "900italic": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreya/v7/-L71QLH_XqgYWaI1GbOVhp0EAVxt0G0biEntp43Qt6E.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Alegreya SC",
   "category": "serif",
   "variants": [
    "regular",
    "italic",
    "700",
    "700italic",
    "900",
    "900italic"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasc/v6/M9OIREoxDkvynwTpBAYUq3e1Pd76Vl7zRpE7NLJQ7XU.ttf",
    "900": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasc/v6/M9OIREoxDkvynwTpBAYUqyenaqEuufTBk9XMKnKmgDA.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasc/v6/3ozeFnTbygMK6PfHh8B-iqCWcynf_cDxXwCLxiixG1c.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasc/v6/GOqmv3FLsJ2r6ZALMZVBmkeOrDcLawS7-ssYqLr2Xp4.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasc/v6/5PCoU7IUfCicpKBJtBmP6c_zJjSACmk0BRPxQqhnNLU.ttf",
    "900italic": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasc/v6/5PCoU7IUfCicpKBJtBmP6U_yTOUGsoC54csJe1b-IRw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Alegreya Sans",
   "category": "sans-serif",
   "variants": [
    "100",
    "100italic",
    "300",
    "300italic",
    "regular",
    "italic",
    "500",
    "500italic",
    "700",
    "700italic",
    "800",
    "800italic",
    "900",
    "900italic"
   ],
   "subsets": [
    "latin-ext",
    "vietnamese",
    "latin"
   ],
   "version": "v3",
   "lastModified": "2015-04-06",
   "files": {
    "100": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasans/v3/TKyx_-JJ6MdpQruNk-t-PJFGFO4uyVFMfB6LZsii7kI.ttf",
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasans/v3/11EDm-lum6tskJMBbdy9acB1LjARzAvdqa1uQC32v70.ttf",
    "500": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasans/v3/11EDm-lum6tskJMBbdy9aQqQmZ7VjhwksfpNVG0pqGc.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasans/v3/11EDm-lum6tskJMBbdy9aVCbmAUID8LN-q3pJpOk3Ys.ttf",
    "800": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasans/v3/11EDm-lum6tskJMBbdy9acxnD5BewVtRRHHljCwR2bM.ttf",
    "900": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasans/v3/11EDm-lum6tskJMBbdy9aW42xlVP-j5dagE7-AU2zwg.ttf",
    "100italic": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasans/v3/gRkSP2lBpqoMTVxg7DmVn2cDnjsrnI9_xJ-5gnBaHsE.ttf",
    "300italic": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasans/v3/WfiXipsmjqRqsDBQ1bA9CnfqlVoxTUFFx1C8tBqmbcg.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasans/v3/KYNzioYhDai7mTMnx_gDgn8f0n03UdmQgF_CLvNR2vg.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasans/v3/TKyx_-JJ6MdpQruNk-t-PD4G9C9ttb0Oz5Cvf0qOitE.ttf",
    "500italic": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasans/v3/WfiXipsmjqRqsDBQ1bA9Cs7DCVO6wo6i5LKIyZDzK40.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasans/v3/WfiXipsmjqRqsDBQ1bA9CpF66r9C4AnxxlBlGd7xY4g.ttf",
    "800italic": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasans/v3/WfiXipsmjqRqsDBQ1bA9CicOAJ_9MkLPbDmrtXDPbIU.ttf",
    "900italic": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasans/v3/WfiXipsmjqRqsDBQ1bA9ChRaDUI9aE8-k7PrIG2iiuo.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Alegreya Sans SC",
   "category": "sans-serif",
   "variants": [
    "100",
    "100italic",
    "300",
    "300italic",
    "regular",
    "italic",
    "500",
    "500italic",
    "700",
    "700italic",
    "800",
    "800italic",
    "900",
    "900italic"
   ],
   "subsets": [
    "latin-ext",
    "vietnamese",
    "latin"
   ],
   "version": "v3",
   "lastModified": "2015-04-06",
   "files": {
    "100": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasanssc/v3/trwFkDJLOJf6hqM93944kVnzStfdnFU-MXbO84aBs_M.ttf",
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasanssc/v3/AjAmkoP1y0Vaad0UPPR46-1IqtfxJspFjzJp0SaQRcI.ttf",
    "500": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasanssc/v3/AjAmkoP1y0Vaad0UPPR46_hHTluI57wqxl55RvSYo3s.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasanssc/v3/AjAmkoP1y0Vaad0UPPR4600aId5t1FC-xZ8nmpa_XLk.ttf",
    "800": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasanssc/v3/AjAmkoP1y0Vaad0UPPR46wQgSHD3Lo1Mif2Wkk5swWA.ttf",
    "900": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasanssc/v3/AjAmkoP1y0Vaad0UPPR461Rf9EWUSEX_PR1d_gLKfpM.ttf",
    "100italic": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasanssc/v3/qG3gA9iy5RpXMH4crZboqqakMVR0XlJhO7VdJ8yYvA4.ttf",
    "300italic": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasanssc/v3/0VweK-TO3aQgazdxg8fs0CnTKaH808trtzttbEg4yVA.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasanssc/v3/6kgb6ZvOagoVIRZyl8XV-EklWX-XdLVn1WTiuGuvKIU.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasanssc/v3/trwFkDJLOJf6hqM93944kTfqo69HNOlCNZvbwAmUtiA.ttf",
    "500italic": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasanssc/v3/0VweK-TO3aQgazdxg8fs0NqVvxKdFVwqwzilqfVd39U.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasanssc/v3/0VweK-TO3aQgazdxg8fs0IBYn3VD6xMEnodOh8pnFw4.ttf",
    "800italic": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasanssc/v3/0VweK-TO3aQgazdxg8fs0HStmCm6Rs90XeztCALm0H8.ttf",
    "900italic": "'.cs_server_protocol().'fonts.gstatic.com/s/alegreyasanssc/v3/0VweK-TO3aQgazdxg8fs0IvtwEfTCJoOJugANj-jWDI.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Alex Brush",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/alexbrush/v6/ooh3KJFbKJSUoIRWfiu8o_esZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Alfa Slab One",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/alfaslabone/v5/Qx6FPcitRwTC_k88tLPc-Yjjx0o0jr6fNXxPgYh_a8Q.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Alice",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/alice/v7/wZTAfivekBqIg-rk63nFvQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Alike",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/alike/v7/Ho8YpRKNk_202fwDiGNIyw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Alike Angular",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/alikeangular/v6/OpeCu4xxI3qO1C7CZcJtPT3XH2uEnVI__ynTBvNyki8.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Allan",
   "category": "display",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/allan/v7/zSxQiwo7wgnr7KkMXhSiag.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/allan/v7/T3lemhgZmLQkQI2Qc2bQHA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Allerta",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/allerta/v7/s9FOEuiJFTNbMe06ifzV8g.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Allerta Stencil",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/allertastencil/v7/CdSZfRtHbQrBohqmzSdDYFf2eT4jUldwg_9fgfY_tHc.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Allura",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/allura/v4/4hcqgZanyuJ2gMYWffIR6A.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Almendra",
   "category": "serif",
   "variants": [
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v8",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/almendra/v8/ZpLdQMj7Q2AFio4nNO6A76CWcynf_cDxXwCLxiixG1c.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/almendra/v8/PDpbB-ZF7deXAAEYPkQOeg.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/almendra/v8/CNWLyiDucqVKVgr4EMidi_esZW2xOQ-xsNqO47m55DA.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/almendra/v8/-tXHKMcnn6FqrhJV3l1e3QJKKGfqHaYFsRG-T3ceEVo.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Almendra Display",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-03",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/almendradisplay/v6/2Zuu97WJ_ez-87yz5Ai8fF6uyC_qD11hrFQ6EGgTJWI.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Almendra SC",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-03",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/almendrasc/v6/IuiLd8Fm9I6raSalxMoWeaCWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Amarante",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/amarante/v4/2dQHjIBWSpydit5zkJZnOw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Amaranth",
   "category": "sans-serif",
   "variants": [
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/amaranth/v6/j5OFHqadfxyLnQRxFeox6qCWcynf_cDxXwCLxiixG1c.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/amaranth/v6/7VcBog22JBHsHXHdnnycTA.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/amaranth/v6/UrJlRY9LcVERJSvggsdBqPesZW2xOQ-xsNqO47m55DA.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/amaranth/v6/BHyuYFj9nqLFNvOvGh0xTwJKKGfqHaYFsRG-T3ceEVo.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Amatic SC",
   "category": "handwriting",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-07-22",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/amaticsc/v7/IDnkRTPGcrSVo50UyYNK7y3USBnSvpkopQaUR-2r7iU.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/amaticsc/v7/MldbRWLFytvqxU1y81xSVg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Amethysta",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/amethysta/v4/1jEo9tOFIJDolAUpBnWbnA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Amiri",
   "category": "serif",
   "variants": [
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "arabic",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-07",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/amiri/v7/WQsR_moz-FNqVwGYgptqiA.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/amiri/v7/ATARrPmSew75SlpOw2YABQ.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/amiri/v7/3t1yTQlLUXBw8htrqlXBrw.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/amiri/v7/uF8aNEyD0bxMeTBg9bFDSPesZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Amita",
   "category": "handwriting",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "devanagari",
    "latin"
   ],
   "version": "v1",
   "lastModified": "2015-06-03",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/amita/v1/cIYA2Lzp7l2pcGsqpUidBg.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/amita/v1/RhdhGBXSJqkHo6g7miTEcQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Anaheim",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/anaheim/v4/t-z8aXHMpgI2gjN_rIflKA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Andada",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/andada/v7/rSFaDqNNQBRw3y19MB5Y4w.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Andika",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "cyrillic-ext",
    "latin-ext",
    "cyrillic",
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/andika/v6/oe-ag1G0lcqZ3IXfeEgaGg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Angkor",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "khmer"
   ],
   "version": "v8",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/angkor/v8/DLpLgIS-8F10ecwKqCm95Q.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Annie Use Your Telescope",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/annieuseyourtelescope/v6/2cuiO5VmaR09C8SLGEQjGqbp7mtG8sPlcZvOaO8HBak.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Anonymous Pro",
   "category": "monospace",
   "variants": [
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "greek",
    "latin-ext",
    "cyrillic",
    "latin"
   ],
   "version": "v8",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/anonymouspro/v8/WDf5lZYgdmmKhO8E1AQud--Cz_5MeePnXDAcLNWyBME.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/anonymouspro/v8/Zhfjj_gat3waL4JSju74E-V_5zh5b-_HiooIRUBwn1A.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/anonymouspro/v8/q0u6LFHwttnT_69euiDbWKwIsuKDCXG0NQm7BvAgx-c.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/anonymouspro/v8/_fVr_XGln-cetWSUc-JpfA1LL9bfs7wyIp6F8OC9RxA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Antic",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/antic/v7/hEa8XCNM7tXGzD0Uk0AipA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Antic Didone",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/anticdidone/v4/r3nJcTDuOluOL6LGDV1vRy3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Antic Slab",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/anticslab/v4/PSbJCTKkAS7skPdkd7AKEvesZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Anton",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-08-14",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/anton/v7/XIbCenm-W0IRHWYIh7CGUQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Arapey",
   "category": "serif",
   "variants": [
    "regular",
    "italic"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/arapey/v5/dqu823lrSYn8T2gApTdslA.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/arapey/v5/pY-Xi5JNBpaWxy2tZhEm5A.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Arbutus",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-03",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/arbutus/v5/Go_hurxoUsn5MnqNVQgodQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Arbutus Slab",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/arbutusslab/v4/6k3Yp6iS9l4jRIpynA8qMy3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Architects Daughter",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/architectsdaughter/v6/RXTgOOQ9AAtaVOHxx0IUBMCy0EhZjHzu-y0e6uLf4Fg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Archivo Black",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/archivoblack/v4/WoAoVT7K3k7hHfxKbvB6B51XQG8isOYYJhPIYAyrESQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Archivo Narrow",
   "category": "sans-serif",
   "variants": [
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/archivonarrow/v5/M__Wu4PAmHf4YZvQM8tWsMLtdzs3iyjn_YuT226ZsLU.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/archivonarrow/v5/DsLzC9scoPnrGiwYYMQXppTvAuddT2xDMbdz0mdLyZY.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/archivonarrow/v5/vqsrtPCpTU3tJlKfuXP5zUpmlyBQEFfdE6dERLXdQGQ.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/archivonarrow/v5/wG6O733y5zHl4EKCOh8rSTg5KB8MNJ4uPAETq9naQO8.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Arimo",
   "category": "sans-serif",
   "variants": [
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "hebrew",
    "cyrillic-ext",
    "greek-ext",
    "greek",
    "latin-ext",
    "vietnamese",
    "cyrillic",
    "latin"
   ],
   "version": "v9",
   "lastModified": "2015-04-28",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/arimo/v9/ZItXugREyvV9LnbY_gxAmw.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/arimo/v9/Gpeo80g-5ji2CcyXWnzh7g.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/arimo/v9/_OdGbnX2-qQ96C4OjhyuPw.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/arimo/v9/__nOLWqmeXdhfr0g7GaFePesZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Arizonia",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/arizonia/v6/yzJqkHZqryZBTM7RKYV9Wg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Armata",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/armata/v6/1H8FwGgIRrbYtxSfXhOHlQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Artifika",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/artifika/v6/Ekfp4H4QG7D-WsABDOyj8g.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Arvo",
   "category": "serif",
   "variants": [
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v9",
   "lastModified": "2015-08-26",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/arvo/v9/OB3FDST7U38u3OjPK_vvRQ.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/arvo/v9/vvWPwz-PlZEwjOOIKqoZzA.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/arvo/v9/id5a4BCjbenl5Gkqonw_Rw.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/arvo/v9/Hvl2MuWoXLaCy2v6MD4Yvw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Arya",
   "category": "sans-serif",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "devanagari",
    "latin"
   ],
   "version": "v1",
   "lastModified": "2015-05-21",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/arya/v1/N13tgOvG7VTXawiI-fJiQA.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/arya/v1/xEVqtU3v8QLospHKpDaYEw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Asap",
   "category": "sans-serif",
   "variants": [
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/asap/v4/o5RUA7SsJ80M8oDFBnrDbg.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/asap/v4/2lf-1MDR8tsTpEtvJmr2hA.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/asap/v4/mwxNHf8QS8gNWCAMwkJNIg.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/asap/v4/_rZz9y2oXc09jT5T6BexLQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Asar",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "devanagari",
    "latin"
   ],
   "version": "v1",
   "lastModified": "2015-06-17",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/asar/v1/mSmn3H5CcMA84CZ586X7WQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Asset",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/asset/v6/hfPmqY-JzuR1lULlQf9iTg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Astloch",
   "category": "display",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/astloch/v6/aPkhM2tL-tz1jX6aX2rvo_esZW2xOQ-xsNqO47m55DA.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/astloch/v6/fmbitVmHYLQP7MGPuFgpag.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Asul",
   "category": "sans-serif",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/asul/v5/uO8uNmxaq87-DdPmkEg5Gg.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/asul/v5/9qpsNR_OOwyOYyo2N0IbBw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Atomic Age",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/atomicage/v6/WvBMe4FxANIKpo6Oi0mVJ_esZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Aubrey",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v8",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/aubrey/v8/zo9w8klO8bmOQIMajQ2aTA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Audiowide",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/audiowide/v4/yGcwRZB6VmoYhPUYT-mEow.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Autour One",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/autourone/v4/2xmQBcg7FN72jaQRFZPIDvesZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Average",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/average/v4/aHUibBqdDbVYl5FM48pxyQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Average Sans",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/averagesans/v4/dnU3R-5A_43y5bIyLztPsS3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Averia Gruesa Libre",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/averiagruesalibre/v4/10vbZTOoN6T8D-nvDzwRFyXcKHuZXlCN8VkWHpkUzKM.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Averia Libre",
   "category": "display",
   "variants": [
    "300",
    "300italic",
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/averialibre/v4/r6hGL8sSLm4dTzOPXgx5XacQoVhARpoaILP7amxE_8g.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/averialibre/v4/r6hGL8sSLm4dTzOPXgx5XUD2ttfZwueP-QU272T9-k4.ttf",
    "300italic": "'.cs_server_protocol().'fonts.gstatic.com/s/averialibre/v4/I6wAYuAvOgT7el2ePj2nkina0FLWfcB-J_SAYmcAXaI.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/averialibre/v4/rYVgHZZQICWnhjguGsBspC3USBnSvpkopQaUR-2r7iU.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/averialibre/v4/1etzuoNxVHR8F533EkD1WfMZXuCXbOrAvx5R0IT5Oyo.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/averialibre/v4/I6wAYuAvOgT7el2ePj2nkvAs9-1nE9qOqhChW0m4nDE.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Averia Sans Libre",
   "category": "display",
   "variants": [
    "300",
    "300italic",
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/averiasanslibre/v4/_9-jTfQjaBsWAF_yp5z-V4CP_KG_g80s1KXiBtJHoNc.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/averiasanslibre/v4/_9-jTfQjaBsWAF_yp5z-V8QwVOrz1y5GihpZmtKLhlI.ttf",
    "300italic": "'.cs_server_protocol().'fonts.gstatic.com/s/averiasanslibre/v4/o7BEIK-fG3Ykc5Rzteh88YuyGu4JqttndUh4gRKxic0.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/averiasanslibre/v4/yRJpjT39KxACO9F31mj_LqV8_KRn4epKAjTFK1s1fsg.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/averiasanslibre/v4/COEzR_NPBSUOl3pFwPbPoCZU2HnUZT1xVKaIrHDioao.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/averiasanslibre/v4/o7BEIK-fG3Ykc5Rzteh88bXy1DXgmJcVtKjM5UWamMs.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Averia Serif Libre",
   "category": "display",
   "variants": [
    "300",
    "300italic",
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/averiaseriflibre/v5/yvITAdr5D1nlsdFswJAb8SmC4gFJ2PHmfdVKEd_5S9M.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/averiaseriflibre/v5/yvITAdr5D1nlsdFswJAb8Q50KV5TaOVolur4zV2iZsg.ttf",
    "300italic": "'.cs_server_protocol().'fonts.gstatic.com/s/averiaseriflibre/v5/YOLFXyye4sZt6AZk1QybCG2okl0bU63CauowU4iApig.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/averiaseriflibre/v5/fdtF30xa_Erw0zAzOoG4BZqY66i8AUyI16fGqw0iAew.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/averiaseriflibre/v5/o9qhvK9iT5iDWfyhQUe-6Ru_b0bTq5iipbJ9hhgHJ6U.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/averiaseriflibre/v5/YOLFXyye4sZt6AZk1QybCNxohRXP4tNDqG3X4Hqn21k.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Bad Script",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "cyrillic",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/badscript/v5/cRyUs0nJ2eMQFHwBsZNRXfesZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Balthazar",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/balthazar/v5/WgbaSIs6dJAGXJ0qbz2xlw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Bangers",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v8",
   "lastModified": "2015-08-14",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/bangers/v8/WAffdge5w99Xif-DLeqmcA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Basic",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/basic/v6/hNII2mS5Dxw5C0u_m3mXgA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Battambang",
   "category": "display",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "khmer"
   ],
   "version": "v9",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/battambang/v9/dezbRtMzfzAA99DmrCYRMgJKKGfqHaYFsRG-T3ceEVo.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/battambang/v9/MzrUfQLefYum5vVGM3EZVPesZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Baumans",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/baumans/v5/o0bFdPW1H5kd5saqqOcoVg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Bayon",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "khmer"
   ],
   "version": "v8",
   "lastModified": "2015-04-03",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/bayon/v8/yTubusjTnpNRZwA4_50iVw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Belgrano",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/belgrano/v6/iq8DUa2s7g6WRCeMiFrmtQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Belleza",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/belleza/v4/wchA3BWJlVqvIcSeNZyXew.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "BenchNine",
   "category": "sans-serif",
   "variants": [
    "300",
    "regular",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/benchnine/v4/ah9xtUy9wLQ3qnWa2p-piS3USBnSvpkopQaUR-2r7iU.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/benchnine/v4/qZpi6ZVZg3L2RL_xoBLxWS3USBnSvpkopQaUR-2r7iU.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/benchnine/v4/h3OAlYqU3aOeNkuXgH2Q2w.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Bentham",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/bentham/v6/5-Mo8Fe7yg5tzV0GlQIuzQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Berkshire Swash",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/berkshireswash/v4/4RZJjVRPjYnC2939hKCAimKfbtsIjCZP_edQljX9gR0.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Bevan",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/bevan/v7/Rtg3zDsCeQiaJ_Qno22OJA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Bigelow Rules",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-03",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/bigelowrules/v4/FEJCPLwo07FS-6SK6Al50X8f0n03UdmQgF_CLvNR2vg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Bigshot One",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/bigshotone/v6/wSyZjBNTWDQHnvWE2jt6j6CWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Bilbo",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/bilbo/v6/-ty-lPs5H7OIucWbnpFrkA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Bilbo Swash Caps",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/bilboswashcaps/v7/UB_-crLvhx-PwGKW1oosDmYeFSdnSpRYv5h9gpdlD1g.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Biryani",
   "category": "sans-serif",
   "variants": [
    "200",
    "300",
    "regular",
    "600",
    "700",
    "800",
    "900"
   ],
   "subsets": [
    "latin-ext",
    "devanagari",
    "latin"
   ],
   "version": "v1",
   "lastModified": "2015-04-22",
   "files": {
    "200": "'.cs_server_protocol().'fonts.gstatic.com/s/biryani/v1/Xx38YzyTFF8n6mRS1Yd88vesZW2xOQ-xsNqO47m55DA.ttf",
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/biryani/v1/u-bneRbizmFMd0VQp5Ze6vesZW2xOQ-xsNqO47m55DA.ttf",
    "600": "'.cs_server_protocol().'fonts.gstatic.com/s/biryani/v1/1EdcPCVxBR2txgjrza6_YPesZW2xOQ-xsNqO47m55DA.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/biryani/v1/qN2MTZ0j1sKSCtfXLB2dR_esZW2xOQ-xsNqO47m55DA.ttf",
    "800": "'.cs_server_protocol().'fonts.gstatic.com/s/biryani/v1/DJyziS7FEy441v22InYdevesZW2xOQ-xsNqO47m55DA.ttf",
    "900": "'.cs_server_protocol().'fonts.gstatic.com/s/biryani/v1/trcLkrIut0lM_PPSyQfAMPesZW2xOQ-xsNqO47m55DA.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/biryani/v1/W7bfR8-IY76Xz0QoB8L2xw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Bitter",
   "category": "serif",
   "variants": [
    "regular",
    "italic",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/bitter/v7/4dUtr_4BvHuoRU35suyOAg.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/bitter/v7/w_BNdJvVZDRmqy5aSfB2kQ.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/bitter/v7/TC0FZEVzXQIGgzmRfKPZbA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Black Ops One",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/blackopsone/v7/2XW-DmDsGbDLE372KrMW1Yjjx0o0jr6fNXxPgYh_a8Q.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Bokor",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "khmer"
   ],
   "version": "v8",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/bokor/v8/uAKdo0A85WW23Gs6mcbw7A.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Bonbon",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-08-12",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/bonbon/v7/IW3u1yzG1knyW5oz0s9_6Q.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Boogaloo",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/boogaloo/v6/4Wu1tvFMoB80fSu8qLgQfQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Bowlby One",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/bowlbyone/v7/eKpHjHfjoxM2bX36YNucefesZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Bowlby One SC",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v8",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/bowlbyonesc/v8/8ZkeXftTuzKBtmxOYXoRedDkZCMxWJecxjvKm2f8MJw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Brawler",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/brawler/v6/3gfSw6imxQnQxweVITqUrg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Bree Serif",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/breeserif/v5/5h9crBVIrvZqgf34FHcnEfesZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Bubblegum Sans",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/bubblegumsans/v5/Y9iTUUNz6lbl6TrvV4iwsytnKWgpfO2iSkLzTz-AABg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Bubbler One",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/bubblerone/v4/e8S0qevkZAFaBybtt_SU4qCWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Buda",
   "category": "display",
   "variants": [
    "300"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/buda/v6/hLtAmNUmEMJH2yx7NGUjnA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Buenard",
   "category": "serif",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-08-12",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/buenard/v7/yUlGE115dGr7O9w9FlP3UvesZW2xOQ-xsNqO47m55DA.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/buenard/v7/NSpMPGKAUgrLrlstYVvIXQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Butcherman",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/butcherman/v7/bxiJmD567sPBVpJsT0XR0vesZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Butterfly Kids",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/butterflykids/v4/J4NTF5M25htqeTffYImtlUZaDk62iwTBnbnvwSjZciA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Cabin",
   "category": "sans-serif",
   "variants": [
    "regular",
    "italic",
    "500",
    "500italic",
    "600",
    "600italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "500": "'.cs_server_protocol().'fonts.gstatic.com/s/cabin/v7/HgsCQ-k3_Z_uQ86aFolNBg.ttf",
    "600": "'.cs_server_protocol().'fonts.gstatic.com/s/cabin/v7/eUDAvKhBtmTCkeVBsFk34A.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/cabin/v7/4EKhProuY1hq_WCAomq9Dg.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/cabin/v7/XeuAFYo2xAPHxZGBbQtHhA.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/cabin/v7/0tJ9k3DI5xC4GBgs1E_Jxw.ttf",
    "500italic": "'.cs_server_protocol().'fonts.gstatic.com/s/cabin/v7/50sjhrGE0njyO-7mGDhGP_esZW2xOQ-xsNqO47m55DA.ttf",
    "600italic": "'.cs_server_protocol().'fonts.gstatic.com/s/cabin/v7/sFQpQDBd3G2om0Nl5dD2CvesZW2xOQ-xsNqO47m55DA.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/cabin/v7/K83QKi8MOKLEqj6bgZ7LrfesZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Cabin Condensed",
   "category": "sans-serif",
   "variants": [
    "regular",
    "500",
    "600",
    "700"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "500": "'.cs_server_protocol().'fonts.gstatic.com/s/cabincondensed/v7/Ez4zJbsGr2BgXcNUWBVgEARL_-ABKXdjsJSPT0lc2Bk.ttf",
    "600": "'.cs_server_protocol().'fonts.gstatic.com/s/cabincondensed/v7/Ez4zJbsGr2BgXcNUWBVgELS5sSASxc8z4EQTQj7DCAI.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/cabincondensed/v7/Ez4zJbsGr2BgXcNUWBVgEMAWgzcA047xWLixhLCofl8.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/cabincondensed/v7/B0txb0blf2N29WdYPJjMSiQPsWWoiv__AzYJ9Zzn9II.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Cabin Sketch",
   "category": "display",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v8",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/cabinsketch/v8/ki3SSN5HMOO0-IOLOj069ED2ttfZwueP-QU272T9-k4.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/cabinsketch/v8/d9fijO34zQajqQvl3YHRCS3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Caesar Dressing",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/caesardressing/v5/2T_WzBgE2Xz3FsyJMq34T9gR43u4FvCuJwIfF5Zxl6Y.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Cagliostro",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/cagliostro/v5/i85oXbtdSatNEzss99bpj_esZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Calligraffitti",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/calligraffitti/v7/vLVN2Y-z65rVu1R7lWdvyDXz_orj3gX0_NzfmYulrko.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Cambay",
   "category": "sans-serif",
   "variants": [
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "latin-ext",
    "devanagari",
    "latin"
   ],
   "version": "v1",
   "lastModified": "2015-04-03",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/cambay/v1/jw9niBxa04eEhnSwTWCEgw.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/cambay/v1/etU9Bab4VuhzS-OKsb1VXg.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/cambay/v1/ZEz9yNqpEOgejaw1rBhugQ.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/cambay/v1/j-5v_uUr0NXTumWN0siOiaCWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Cambo",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/cambo/v5/PnwpRuTdkYCf8qk4ajmNRA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Candal",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/candal/v6/x44dDW28zK7GR1gGDBmj9g.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Cantarell",
   "category": "sans-serif",
   "variants": [
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/cantarell/v6/Yir4ZDsCn4g1kWopdg-ehC3USBnSvpkopQaUR-2r7iU.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/cantarell/v6/p5ydP_uWQ5lsFzcP_XVMEw.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/cantarell/v6/DTCLtOSqP-7dgM-V_xKUjqCWcynf_cDxXwCLxiixG1c.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/cantarell/v6/weehrwMeZBXb0QyrWnRwFXe1Pd76Vl7zRpE7NLJQ7XU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Cantata One",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/cantataone/v5/-a5FDvnBqaBMDaGgZYnEfqCWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Cantora One",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/cantoraone/v5/oI-DS62RbHI8ZREjp73ehqCWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Capriola",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/capriola/v4/JxXPlkdzWwF9Cwelbvi9jA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Cardo",
   "category": "serif",
   "variants": [
    "regular",
    "italic",
    "700"
   ],
   "subsets": [
    "greek-ext",
    "greek",
    "latin-ext",
    "latin"
   ],
   "version": "v8",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/cardo/v8/lQN30weILimrKvp8rZhF1w.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/cardo/v8/jbkF2_R0FKUEZTq5dwSknQ.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/cardo/v8/pcv4Np9tUkq0YREYUcEEJQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Carme",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/carme/v7/08E0NP1eRBEyFRUadmMfgA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Carrois Gothic",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/carroisgothic/v4/GCgb7bssGpwp7V5ynxmWy2x3d0cwUleGuRTmCYfCUaM.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Carrois Gothic SC",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/carroisgothicsc/v4/bVp4nhwFIXU-r3LqUR8DSJTdPW1ioadGi2uRiKgJVCY.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Carter One",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v8",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/carterone/v8/5X_LFvdbcB7OBG7hBgZ7fPesZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Catamaran",
   "category": "sans-serif",
   "variants": [
    "100",
    "200",
    "300",
    "regular",
    "500",
    "600",
    "700",
    "800",
    "900"
   ],
   "subsets": [
    "tamil",
    "latin-ext",
    "latin"
   ],
   "version": "v1",
   "lastModified": "2015-08-06",
   "files": {
    "100": "'.cs_server_protocol().'fonts.gstatic.com/s/catamaran/v1/ilWHBiy0krUPdlmYxDuqC6CWcynf_cDxXwCLxiixG1c.ttf",
    "200": "'.cs_server_protocol().'fonts.gstatic.com/s/catamaran/v1/hFc-HKSsGk6M-psujei1MC3USBnSvpkopQaUR-2r7iU.ttf",
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/catamaran/v1/Aaag4ccR7Oh_4eai-jbrYC3USBnSvpkopQaUR-2r7iU.ttf",
    "500": "'.cs_server_protocol().'fonts.gstatic.com/s/catamaran/v1/83WSX3F86qsvj1Z4EI0tQi3USBnSvpkopQaUR-2r7iU.ttf",
    "600": "'.cs_server_protocol().'fonts.gstatic.com/s/catamaran/v1/a9PlHHnuBWiGGk0TwuFKTi3USBnSvpkopQaUR-2r7iU.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/catamaran/v1/PpgVtUHUdnBZYNpnzGbScy3USBnSvpkopQaUR-2r7iU.ttf",
    "800": "'.cs_server_protocol().'fonts.gstatic.com/s/catamaran/v1/6VjB_uSfn3DZ93IQv58CmC3USBnSvpkopQaUR-2r7iU.ttf",
    "900": "'.cs_server_protocol().'fonts.gstatic.com/s/catamaran/v1/5ys9TqpQc9Q6gHqbSox6py3USBnSvpkopQaUR-2r7iU.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/catamaran/v1/MdNkM-DU8f6R-25Nxpr_XA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Caudex",
   "category": "serif",
   "variants": [
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "greek-ext",
    "greek",
    "latin-ext",
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/caudex/v6/PetCI4GyQ5Q3LiOzUu_mMg.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/caudex/v6/PWEexiHLDmQbn2b1OPZWfg.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/caudex/v6/XjMZF6XCisvV3qapD4oJdw.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/caudex/v6/yT8YeHLjaJvQXlUEYOA8gqCWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Cedarville Cursive",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-08-12",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/cedarvillecursive/v7/cuCe6HrkcqrWTWTUE7dw-41zwq9-z_Lf44CzRAA0d0Y.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Ceviche One",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/cevicheone/v6/WOaXIMBD4VYMy39MsobJhKCWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Changa One",
   "category": "display",
   "variants": [
    "regular",
    "italic"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v9",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/changaone/v9/dr4qjce4W3kxFrZRkVD87fesZW2xOQ-xsNqO47m55DA.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/changaone/v9/wJVQlUs1lAZel-WdTo2U9y3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Chango",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/chango/v5/3W3AeMMtRTH08t5qLOjBmg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Chau Philomene One",
   "category": "sans-serif",
   "variants": [
    "regular",
    "italic"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/chauphilomeneone/v4/KKc5egCL-a2fFVoOA2x6tBFi5dxgSTdxqnMJgWkBJcg.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/chauphilomeneone/v4/eJj1PY_iN4KiIuyOvtMHJP6uyLkxyiC4WcYA74sfquE.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Chela One",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/chelaone/v4/h5O0dEnpnIq6jQnWxZybrA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Chelsea Market",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/chelseamarket/v4/qSdzwh2A4BbNemy78sJLfAAI1i8fIftCBXsBF2v9UMI.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Chenla",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "khmer"
   ],
   "version": "v9",
   "lastModified": "2015-04-03",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/chenla/v9/aLNpdAUDq2MZbWz2U1a16g.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Cherry Cream Soda",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/cherrycreamsoda/v6/OrD-AUnFcZeeKa6F_c0_WxOiHiuAPYA9ry3O1RG2XIU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Cherry Swash",
   "category": "display",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/cherryswash/v4/-CfyMyQqfucZPQNB0nvYyED2ttfZwueP-QU272T9-k4.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/cherryswash/v4/HqOk7C7J1TZ5i3L-ejF0vi3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Chewy",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/chewy/v7/hcDN5cvQdIu6Bx4mg_TSyw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Chicle",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/chicle/v5/xg4q57Ut9ZmyFwLp51JLgg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Chivo",
   "category": "sans-serif",
   "variants": [
    "regular",
    "italic",
    "900",
    "900italic"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "900": "'.cs_server_protocol().'fonts.gstatic.com/s/chivo/v7/JAdkiWd46QCW4vOsj3dzTA.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/chivo/v7/L88PEuzS9eRfHRZhAPhZyw.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/chivo/v7/Oe3-Q-a2kBzPnhHck_baMg.ttf",
    "900italic": "'.cs_server_protocol().'fonts.gstatic.com/s/chivo/v7/LoszYnE86q2wJEOjCigBQ_esZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Chonburi",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "vietnamese",
    "thai",
    "latin"
   ],
   "version": "v1",
   "lastModified": "2015-08-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/chonburi/v1/jd9PfbW0x_8Myt_XeUxvSQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Cinzel",
   "category": "serif",
   "variants": [
    "regular",
    "700",
    "900"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/cinzel/v4/nYcFQ6_3pf_6YDrOFjBR8Q.ttf",
    "900": "'.cs_server_protocol().'fonts.gstatic.com/s/cinzel/v4/FTBj72ozM2cEOSxiVsRb3A.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/cinzel/v4/GF7dy_Nc-a6EaHYSyGd-EA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Cinzel Decorative",
   "category": "display",
   "variants": [
    "regular",
    "700",
    "900"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/cinzeldecorative/v4/pXhIVnhFtL_B9Vb1wq2F95-YYVDmZkJErg0zgx9XuZI.ttf",
    "900": "'.cs_server_protocol().'fonts.gstatic.com/s/cinzeldecorative/v4/pXhIVnhFtL_B9Vb1wq2F97Khqbv0zQZa0g-9HOXAalU.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/cinzeldecorative/v4/fmgK7oaJJIXAkhd9798yQgT5USbJx2F82lQbogPy2bY.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Clicker Script",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/clickerscript/v4/Zupmk8XwADjufGxWB9KThBnpV0hQCek3EmWnCPrvGRM.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Coda",
   "category": "display",
   "variants": [
    "regular",
    "800"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v11",
   "lastModified": "2015-08-14",
   "files": {
    "800": "'.cs_server_protocol().'fonts.gstatic.com/s/coda/v11/6ZIw0sbALY0KTMWllZB3hQ.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/coda/v11/yHDvulhg-P-p2KRgRrnUYw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Coda Caption",
   "category": "sans-serif",
   "variants": [
    "800"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v9",
   "lastModified": "2015-08-12",
   "files": {
    "800": "'.cs_server_protocol().'fonts.gstatic.com/s/codacaption/v9/YDl6urZh-DUFhiMBTgAnz_qsay_1ZmRGmC8pVRdIfAg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Codystar",
   "category": "display",
   "variants": [
    "300",
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/codystar/v4/EVaUzfJkcb8Zqx9kzQLXqqCWcynf_cDxXwCLxiixG1c.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/codystar/v4/EN-CPFKYowSI7SuR7-0cZA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Combo",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/combo/v5/Nab98KjR3JZSSPGtzLyXNw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Comfortaa",
   "category": "display",
   "variants": [
    "300",
    "regular",
    "700"
   ],
   "subsets": [
    "cyrillic-ext",
    "greek",
    "latin-ext",
    "cyrillic",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/comfortaa/v7/r_tUZNl0G8xCoOmp_JkSCi3USBnSvpkopQaUR-2r7iU.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/comfortaa/v7/fND5XPYKrF2tQDwwfWZJIy3USBnSvpkopQaUR-2r7iU.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/comfortaa/v7/lZx6C1VViPgSOhCBUP7hXA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Coming Soon",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/comingsoon/v6/Yz2z3IAe2HSQAOWsSG8COKCWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Concert One",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/concertone/v7/N5IWCIGhUNdPZn_efTxKN6CWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Condiment",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/condiment/v4/CstmdiPpgFSV0FUNL5LrJA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Content",
   "category": "display",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "khmer"
   ],
   "version": "v8",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/content/v8/7PivP8Zvs2qn6F6aNbSQe_esZW2xOQ-xsNqO47m55DA.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/content/v8/l8qaLjygvOkDEU2G6-cjfQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Contrail One",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/contrailone/v6/b41KxjgiyqX-hkggANDU6C3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Convergence",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/convergence/v5/eykrGz1NN_YpQmkAZjW-qKCWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Cookie",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/cookie/v7/HxeUC62y_YdDbiFlze357A.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Copse",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/copse/v6/wikLrtPGjZDvZ5w2i5HLWg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Corben",
   "category": "display",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v9",
   "lastModified": "2015-08-12",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/corben/v9/lirJaFSQWdGQuV--fksg5g.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/corben/v9/tTysMZkt-j8Y5yhkgsoajQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Courgette",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/courgette/v4/2YO0EYtyE9HUPLZprahpZA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Cousine",
   "category": "monospace",
   "variants": [
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "hebrew",
    "cyrillic-ext",
    "greek-ext",
    "greek",
    "latin-ext",
    "vietnamese",
    "cyrillic",
    "latin"
   ],
   "version": "v10",
   "lastModified": "2015-04-28",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/cousine/v10/FXEOnNUcCzhdtoBxiq-lovesZW2xOQ-xsNqO47m55DA.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/cousine/v10/GYX4bPXObJNJo63QJEUnLg.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/cousine/v10/1WtIuajLoo8vjVwsrZ3eOg.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/cousine/v10/y_AZ5Sz-FwL1lux2xLSTZS3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Coustard",
   "category": "serif",
   "variants": [
    "regular",
    "900"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "900": "'.cs_server_protocol().'fonts.gstatic.com/s/coustard/v6/W02OCWO6OfMUHz6aVyegQ6CWcynf_cDxXwCLxiixG1c.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/coustard/v6/iO2Rs5PmqAEAXoU3SkMVBg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Covered By Your Grace",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/coveredbyyourgrace/v6/6ozZp4BPlrbDRWPe3EBGA6CVUMdvnk-GcAiZQrX9Gek.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Crafty Girls",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/craftygirls/v5/0Sv8UWFFdhQmesHL32H8oy3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Creepster",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/creepster/v5/0vdr5kWJ6aJlOg5JvxnXzQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Crete Round",
   "category": "serif",
   "variants": [
    "regular",
    "italic"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/creteround/v5/B8EwN421qqOCCT8vOH4wJ6CWcynf_cDxXwCLxiixG1c.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/creteround/v5/5xAt7XK2vkUdjhGtt98unUeOrDcLawS7-ssYqLr2Xp4.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Crimson Text",
   "category": "serif",
   "variants": [
    "regular",
    "italic",
    "600",
    "600italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "600": "'.cs_server_protocol().'fonts.gstatic.com/s/crimsontext/v6/rEy5tGc5HdXy56Xvd4f3I2v8CylhIUtwUiYO7Z2wXbE.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/crimsontext/v6/rEy5tGc5HdXy56Xvd4f3I0D2ttfZwueP-QU272T9-k4.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/crimsontext/v6/3IFMwfRa07i-auYR-B-zNS3USBnSvpkopQaUR-2r7iU.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/crimsontext/v6/a5QZnvmn5amyNI-t2BMkWPMZXuCXbOrAvx5R0IT5Oyo.ttf",
    "600italic": "'.cs_server_protocol().'fonts.gstatic.com/s/crimsontext/v6/4j4TR-EfnvCt43InYpUNDIR-5-urNOGAobhAyctHvW8.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/crimsontext/v6/4j4TR-EfnvCt43InYpUNDPAs9-1nE9qOqhChW0m4nDE.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Croissant One",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/croissantone/v4/mPjsOObnC77fp1cvZlOfIYjjx0o0jr6fNXxPgYh_a8Q.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Crushed",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/crushed/v6/aHwSejs3Kt0Lg95u7j32jA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Cuprum",
   "category": "sans-serif",
   "variants": [
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "latin-ext",
    "cyrillic",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/cuprum/v7/6tl3_FkDeXSD72oEHuJh4w.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/cuprum/v7/JgXs0F_UiaEdAS74msmFNg.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/cuprum/v7/cLEz0KV6OxInnktSzpk58g.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/cuprum/v7/bnkXaBfoYvaJ75axRPSwVKCWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Cutive",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v8",
   "lastModified": "2015-08-14",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/cutive/v8/G2bW-ImyOCwKxBkLyz39YQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Cutive Mono",
   "category": "monospace",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/cutivemono/v4/ncWQtFVKcSs8OW798v30k6CWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Damion",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/damion/v6/13XtECwKxhD_VrOqXL4SiA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Dancing Script",
   "category": "handwriting",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/dancingscript/v6/KGBfwabt0ZRLA5W1ywjowb_dAmXiKjTPGCuO6G2MbfA.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/dancingscript/v6/DK0eTGXiZjN6yA8zAEyM2RnpV0hQCek3EmWnCPrvGRM.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Dangrek",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "khmer"
   ],
   "version": "v8",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/dangrek/v8/LOaFhBT-EHNxZjV8DAW_ew.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Dawning of a New Day",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/dawningofanewday/v7/JiDsRhiKZt8uz3NJ5xA06gXLnohmOYWQZqo_sW8GLTk.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Days One",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/daysone/v6/kzwZjNhc1iabMsrc_hKBIA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Dekko",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "devanagari",
    "latin"
   ],
   "version": "v2",
   "lastModified": "2015-04-03",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/dekko/v2/AKtgABKC1rUxgIgS-bpojw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Delius",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/delius/v6/TQA163qafki2-gV-B6F_ag.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Delius Swash Caps",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v8",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/deliusswashcaps/v8/uXyrEUnoWApxIOICunRq7yIrxb5zDVgU2N3VzXm7zq4.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Delius Unicase",
   "category": "handwriting",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v9",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/deliusunicase/v9/7FTMTITcb4dxUp99FAdTqNy5weKXdcrx-wE0cgECMq8.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/deliusunicase/v9/b2sKujV3Q48RV2PQ0k1vqu6rPKfVZo7L2bERcf0BDns.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Della Respira",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/dellarespira/v4/F4E6Lo_IZ6L9AJCcbqtDVeDcg5akpSnIcsPhLOFv7l8.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Denk One",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/denkone/v4/TdXOeA4eA_hEx4W8Sh9wPw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Devonshire",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/devonshire/v5/I3ct_2t12SYizP8ZC-KFi_esZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Dhurjati",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "telugu",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-07",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/dhurjati/v4/uV6jO5e2iFMbGB0z79Cy5g.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Didact Gothic",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "cyrillic-ext",
    "greek-ext",
    "greek",
    "latin-ext",
    "cyrillic",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/didactgothic/v7/v8_72sD3DYMKyM0dn3LtWotBLojGU5Qdl8-5NL4v70w.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Diplomata",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-03-20",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/diplomata/v6/u-ByBiKgN6rTMA36H3kcKg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Diplomata SC",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-03",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/diplomatasc/v5/JdVwAwfE1a_pahXjk5qpNi3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Domine",
   "category": "serif",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/domine/v4/phBcG1ZbQFxUIt18hPVxnw.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/domine/v4/wfVIgamVFjMNQAEWurCiHA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Donegal One",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/donegalone/v4/6kN4-fDxz7T9s5U61HwfF6CWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Doppio One",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/doppioone/v4/WHZ3HJQotpk_4aSMNBo_t_esZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Dorsa",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/dorsa/v7/wCc3cUe6XrmG2LQE6GlIrw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Dosis",
   "category": "sans-serif",
   "variants": [
    "200",
    "300",
    "regular",
    "500",
    "600",
    "700",
    "800"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "200": "'.cs_server_protocol().'fonts.gstatic.com/s/dosis/v4/ztftab0r6hcd7AeurUGrSQ.ttf",
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/dosis/v4/awIB6L0h5mb0plIKorXmuA.ttf",
    "500": "'.cs_server_protocol().'fonts.gstatic.com/s/dosis/v4/ruEXDOFMxDPGnjCBKRqdAQ.ttf",
    "600": "'.cs_server_protocol().'fonts.gstatic.com/s/dosis/v4/KNAswRNwm3tfONddYyidxg.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/dosis/v4/AEEAj0ONidK8NQQMBBlSig.ttf",
    "800": "'.cs_server_protocol().'fonts.gstatic.com/s/dosis/v4/nlrKd8E69vvUU39XGsvR7Q.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/dosis/v4/rJRlixu-w0JZ1MyhJpao_Q.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Dr Sugiyama",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-03",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/drsugiyama/v5/S5Yx3MIckgoyHhhS4C9Tv6CWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Droid Sans",
   "category": "sans-serif",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/droidsans/v6/EFpQQyG9GqCrobXxL-KRMQJKKGfqHaYFsRG-T3ceEVo.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/droidsans/v6/rS9BT6-asrfjpkcV3DXf__esZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Droid Sans Mono",
   "category": "monospace",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/droidsansmono/v7/ns-m2xQYezAtqh7ai59hJcwD6PD0c3_abh9zHKQtbGU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Droid Serif",
   "category": "serif",
   "variants": [
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/droidserif/v6/QQt14e8dY39u-eYBZmppwXe1Pd76Vl7zRpE7NLJQ7XU.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/droidserif/v6/DgAtPy6rIVa2Zx3Xh9KaNaCWcynf_cDxXwCLxiixG1c.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/droidserif/v6/cj2hUnSRBhwmSPr9kS5890eOrDcLawS7-ssYqLr2Xp4.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/droidserif/v6/c92rD_x0V1LslSFt3-QEps_zJjSACmk0BRPxQqhnNLU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Duru Sans",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v9",
   "lastModified": "2015-07-30",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/durusans/v9/xn7iYH8xwmSyTvEV_HOxTw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Dynalight",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/dynalight/v5/-CWsIe8OUDWTIHjSAh41kA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "EB Garamond",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "cyrillic-ext",
    "latin-ext",
    "vietnamese",
    "cyrillic",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/ebgaramond/v7/CDR0kuiFK7I1OZ2hSdR7G6CWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Eagle Lake",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/eaglelake/v4/ZKlYin7caemhx9eSg6RvPfesZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Eater",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/eater/v5/gm6f3OmYEdbs3lPQtUfBkA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Economica",
   "category": "sans-serif",
   "variants": [
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/economica/v4/UK4l2VEpwjv3gdcwbwXE9C3USBnSvpkopQaUR-2r7iU.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/economica/v4/G4rJRujzZbq9Nxngu9l3hg.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/economica/v4/p5O9AVeUqx_n35xQRinNYaCWcynf_cDxXwCLxiixG1c.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/economica/v4/ac5dlUsedQ03RqGOeay-3Xe1Pd76Vl7zRpE7NLJQ7XU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Eczar",
   "category": "serif",
   "variants": [
    "regular",
    "500",
    "600",
    "700",
    "800"
   ],
   "subsets": [
    "latin-ext",
    "devanagari",
    "latin"
   ],
   "version": "v2",
   "lastModified": "2015-08-12",
   "files": {
    "500": "'.cs_server_protocol().'fonts.gstatic.com/s/eczar/v2/Ooe4KaPp2594tF8TbMfdlQ.ttf",
    "600": "'.cs_server_protocol().'fonts.gstatic.com/s/eczar/v2/IjQsWW0bmgkZ6lnN72cnTQ.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/eczar/v2/ELC8RVXfBMb3VuuHtMwBOA.ttf",
    "800": "'.cs_server_protocol().'fonts.gstatic.com/s/eczar/v2/9Uyt6nTZLx_Qj5_WRah-iQ.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/eczar/v2/uKZcAQ5JBBs1UbeXFRbBRg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Ek Mukta",
   "category": "sans-serif",
   "variants": [
    "200",
    "300",
    "regular",
    "500",
    "600",
    "700",
    "800"
   ],
   "subsets": [
    "latin-ext",
    "devanagari",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "200": "'.cs_server_protocol().'fonts.gstatic.com/s/ekmukta/v7/crtkNHh5JcM3VJKG0E-B36CWcynf_cDxXwCLxiixG1c.ttf",
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/ekmukta/v7/mpaAv7CIyk0VnZlqSneVxKCWcynf_cDxXwCLxiixG1c.ttf",
    "500": "'.cs_server_protocol().'fonts.gstatic.com/s/ekmukta/v7/PZ1y2MstFczWvBlFSgzMyaCWcynf_cDxXwCLxiixG1c.ttf",
    "600": "'.cs_server_protocol().'fonts.gstatic.com/s/ekmukta/v7/Z5Mfzeu6M3emakcJO2QeTqCWcynf_cDxXwCLxiixG1c.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/ekmukta/v7/4ugcOGR28Jn-oBIn0-qLYaCWcynf_cDxXwCLxiixG1c.ttf",
    "800": "'.cs_server_protocol().'fonts.gstatic.com/s/ekmukta/v7/O68TH5OjEhVmn9_gIrcfS6CWcynf_cDxXwCLxiixG1c.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/ekmukta/v7/aFcjXdC5jyJ1p8w54wIIrg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Electrolize",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/electrolize/v5/yFVu5iokC-nt4B1Cyfxb9aCWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Elsie",
   "category": "display",
   "variants": [
    "regular",
    "900"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "900": "'.cs_server_protocol().'fonts.gstatic.com/s/elsie/v5/1t-9f0N2NFYwAgN7oaISqg.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/elsie/v5/gwspePauE45BJu6Ok1QrfQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Elsie Swash Caps",
   "category": "display",
   "variants": [
    "regular",
    "900"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "900": "'.cs_server_protocol().'fonts.gstatic.com/s/elsieswashcaps/v4/iZnus9qif0tR5pGaDv5zdKoKBWBozTtxi30NfZDOXXU.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/elsieswashcaps/v4/9L3hIJMPCf6sxCltnxd6X2YeFSdnSpRYv5h9gpdlD1g.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Emblema One",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/emblemaone/v5/7IlBUjBWPIiw7cr_O2IfSaCWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Emilys Candy",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/emilyscandy/v4/PofLVm6v1SwZGOzC8s-I3S3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Engagement",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/engagement/v5/4Uz0Jii7oVPcaFRYmbpU6vesZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Englebert",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/englebert/v4/sll38iOvOuarDTYBchlP3Q.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Enriqueta",
   "category": "serif",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/enriqueta/v5/I27Pb-wEGH2ajLYP0QrtSC3USBnSvpkopQaUR-2r7iU.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/enriqueta/v5/_p90TrIwR1SC-vDKtmrv6A.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Erica One",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-03",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/ericaone/v6/cIBnH2VAqQMIGYAcE4ufvQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Esteban",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/esteban/v4/ESyhLgqDDyK5JcFPp2svDw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Euphoria Script",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/euphoriascript/v4/c4XB4Iijj_NvSsCF4I0O2MxLhO8OSNnfAp53LK1_iRs.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Ewert",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/ewert/v4/Em8hrzuzSbfHcTVqMjbAQg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Exo",
   "category": "sans-serif",
   "variants": [
    "100",
    "100italic",
    "200",
    "200italic",
    "300",
    "300italic",
    "regular",
    "italic",
    "500",
    "500italic",
    "600",
    "600italic",
    "700",
    "700italic",
    "800",
    "800italic",
    "900",
    "900italic"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "100": "'.cs_server_protocol().'fonts.gstatic.com/s/exo/v4/RI7A9uwjRmPbVp0n8e-Jvg.ttf",
    "200": "'.cs_server_protocol().'fonts.gstatic.com/s/exo/v4/F8OfC_swrRRxpFt-tlXZQg.ttf",
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/exo/v4/SBrN7TKUqgGUvfxqHqsnNw.ttf",
    "500": "'.cs_server_protocol().'fonts.gstatic.com/s/exo/v4/jCg6DmGGXt_OVyp5ofQHPw.ttf",
    "600": "'.cs_server_protocol().'fonts.gstatic.com/s/exo/v4/q_SG5kXUmOcIvFpgtdZnlw.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/exo/v4/3_jwsL4v9uHjl5Q37G57mw.ttf",
    "800": "'.cs_server_protocol().'fonts.gstatic.com/s/exo/v4/yLPuxBuV0lzqibRJyooOJg.ttf",
    "900": "'.cs_server_protocol().'fonts.gstatic.com/s/exo/v4/97d0nd6Yv4-SA_X92xAuZA.ttf",
    "100italic": "'.cs_server_protocol().'fonts.gstatic.com/s/exo/v4/qtGyZZlWb2EEvby3ZPosxw.ttf",
    "200italic": "'.cs_server_protocol().'fonts.gstatic.com/s/exo/v4/fr4HBfXHYiIngW2_bhlgRw.ttf",
    "300italic": "'.cs_server_protocol().'fonts.gstatic.com/s/exo/v4/3gmiLjBegIfcDLISjTGA1g.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/exo/v4/eUEzTFueNXRVhbt4PEB8kQ.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/exo/v4/cfgolWisMSURhpQeVHl_NA.ttf",
    "500italic": "'.cs_server_protocol().'fonts.gstatic.com/s/exo/v4/lo5eTdCNJZQVN08p8RnzAQ.ttf",
    "600italic": "'.cs_server_protocol().'fonts.gstatic.com/s/exo/v4/0cExa8K_pxS2lTuMr68XUA.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/exo/v4/0me55yJIxd5vyQ9bF7SsiA.ttf",
    "800italic": "'.cs_server_protocol().'fonts.gstatic.com/s/exo/v4/n3LejeKVj_8gtZq5fIgNYw.ttf",
    "900italic": "'.cs_server_protocol().'fonts.gstatic.com/s/exo/v4/JHTkQVhzyLtkY13Ye95TJQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Exo 2",
   "category": "sans-serif",
   "variants": [
    "100",
    "100italic",
    "200",
    "200italic",
    "300",
    "300italic",
    "regular",
    "italic",
    "500",
    "500italic",
    "600",
    "600italic",
    "700",
    "700italic",
    "800",
    "800italic",
    "900",
    "900italic"
   ],
   "subsets": [
    "latin-ext",
    "cyrillic",
    "latin"
   ],
   "version": "v3",
   "lastModified": "2015-04-06",
   "files": {
    "100": "'.cs_server_protocol().'fonts.gstatic.com/s/exo2/v3/oVOtQy53isv97g4UhBUDqg.ttf",
    "200": "'.cs_server_protocol().'fonts.gstatic.com/s/exo2/v3/qa-Ci2pBwJdCxciE1ErifQ.ttf",
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/exo2/v3/nLUBdz_lHHoVIPor05Byhw.ttf",
    "500": "'.cs_server_protocol().'fonts.gstatic.com/s/exo2/v3/oM0rzUuPqVJpW-VEIpuW5w.ttf",
    "600": "'.cs_server_protocol().'fonts.gstatic.com/s/exo2/v3/YnSn3HsyvyI1feGSdRMYqA.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/exo2/v3/2DiK4XkdTckfTk6we73-bQ.ttf",
    "800": "'.cs_server_protocol().'fonts.gstatic.com/s/exo2/v3/IVYl_7dJruOg8zKRpC8Hrw.ttf",
    "900": "'.cs_server_protocol().'fonts.gstatic.com/s/exo2/v3/e8csG8Wnu87AF6uCndkFRQ.ttf",
    "100italic": "'.cs_server_protocol().'fonts.gstatic.com/s/exo2/v3/LNYVgsJcaCxoKFHmd4AZcg.ttf",
    "200italic": "'.cs_server_protocol().'fonts.gstatic.com/s/exo2/v3/DCrVxDVvS69n50O-5erZVvesZW2xOQ-xsNqO47m55DA.ttf",
    "300italic": "'.cs_server_protocol().'fonts.gstatic.com/s/exo2/v3/iSy9VTeUTiqiurQg2ywtu_esZW2xOQ-xsNqO47m55DA.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/exo2/v3/Pf_kZuIH5c5WKVkQUaeSWQ.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/exo2/v3/xxA5ZscX9sTU6U0lZJUlYA.ttf",
    "500italic": "'.cs_server_protocol().'fonts.gstatic.com/s/exo2/v3/amzRVCB-gipwdihZZ2LtT_esZW2xOQ-xsNqO47m55DA.ttf",
    "600italic": "'.cs_server_protocol().'fonts.gstatic.com/s/exo2/v3/Vmo58BiptGwfVFb0teU5gPesZW2xOQ-xsNqO47m55DA.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/exo2/v3/Sdo-zW-4_--pDkTg6bYrY_esZW2xOQ-xsNqO47m55DA.ttf",
    "800italic": "'.cs_server_protocol().'fonts.gstatic.com/s/exo2/v3/p0TA6KeOz1o4rySEbvUxI_esZW2xOQ-xsNqO47m55DA.ttf",
    "900italic": "'.cs_server_protocol().'fonts.gstatic.com/s/exo2/v3/KPhsGCoT2-7Uj6pMlRscH_esZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Expletus Sans",
   "category": "display",
   "variants": [
    "regular",
    "italic",
    "500",
    "500italic",
    "600",
    "600italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v8",
   "lastModified": "2015-08-12",
   "files": {
    "500": "'.cs_server_protocol().'fonts.gstatic.com/s/expletussans/v8/cl6rhMY77Ilk8lB_uYRRwAqQmZ7VjhwksfpNVG0pqGc.ttf",
    "600": "'.cs_server_protocol().'fonts.gstatic.com/s/expletussans/v8/cl6rhMY77Ilk8lB_uYRRwCvj1tU7IJMS3CS9kCx2B3U.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/expletussans/v8/cl6rhMY77Ilk8lB_uYRRwFCbmAUID8LN-q3pJpOk3Ys.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/expletussans/v8/gegTSDBDs5le3g6uxU1ZsX8f0n03UdmQgF_CLvNR2vg.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/expletussans/v8/Y-erXmY0b6DU_i2Qu0hTJj4G9C9ttb0Oz5Cvf0qOitE.ttf",
    "500italic": "'.cs_server_protocol().'fonts.gstatic.com/s/expletussans/v8/sRBNtc46w65uJE451UYmW87DCVO6wo6i5LKIyZDzK40.ttf",
    "600italic": "'.cs_server_protocol().'fonts.gstatic.com/s/expletussans/v8/sRBNtc46w65uJE451UYmW8yKH23ZS6zCKOFHG0e_4JE.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/expletussans/v8/sRBNtc46w65uJE451UYmW5F66r9C4AnxxlBlGd7xY4g.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Fanwood Text",
   "category": "serif",
   "variants": [
    "regular",
    "italic"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/fanwoodtext/v6/hDNDHUlsSb8bgnEmDp4T_i3USBnSvpkopQaUR-2r7iU.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/fanwoodtext/v6/0J3SBbkMZqBV-3iGxs5E9_MZXuCXbOrAvx5R0IT5Oyo.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Fascinate",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-03",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/fascinate/v5/ZE0637WWkBPKt1AmFaqD3Q.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Fascinate Inline",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-03",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/fascinateinline/v6/lRguYfMfWArflkm5aOQ5QJmp8DTZ6iHear7UV05iykg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Faster One",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/fasterone/v5/YxTOW2sf56uxD1T7byP5K_esZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Fasthand",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "khmer"
   ],
   "version": "v7",
   "lastModified": "2015-04-03",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/fasthand/v7/6XAagHH_KmpZL67wTvsETQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Fauna One",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/faunaone/v4/8kL-wpAPofcAMELI_5NRnQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Federant",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/federant/v7/tddZFSiGvxICNOGra0i5aA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Federo",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v8",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/federo/v8/JPhe1S2tujeyaR79gXBLeQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Felipa",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/felipa/v4/SeyfyFZY7abAQXGrOIYnYg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Fenix",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/fenix/v4/Ak8wR3VSlAN7VN_eMeJj7Q.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Finger Paint",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/fingerpaint/v4/m_ZRbiY-aPb13R3DWPBGXy3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Fira Mono",
   "category": "monospace",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "cyrillic-ext",
    "greek",
    "latin-ext",
    "cyrillic",
    "latin"
   ],
   "version": "v3",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/firamono/v3/l24Wph3FsyKAbJ8dfExTZy3USBnSvpkopQaUR-2r7iU.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/firamono/v3/WQOm1D4RO-yvA9q9trJc8g.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Fira Sans",
   "category": "sans-serif",
   "variants": [
    "300",
    "300italic",
    "regular",
    "italic",
    "500",
    "500italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "cyrillic-ext",
    "greek",
    "latin-ext",
    "cyrillic",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/firasans/v5/VTBnrK42EiOBncVyQXZ7jy3USBnSvpkopQaUR-2r7iU.ttf",
    "500": "'.cs_server_protocol().'fonts.gstatic.com/s/firasans/v5/zM2u8V3CuPVwAAXFQcDi4C3USBnSvpkopQaUR-2r7iU.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/firasans/v5/DugPdSljmOTocZOR2CItOi3USBnSvpkopQaUR-2r7iU.ttf",
    "300italic": "'.cs_server_protocol().'fonts.gstatic.com/s/firasans/v5/6s0YCA9oCTF6hM60YM-qTS9-WlPSxbfiI49GsXo3q0g.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/firasans/v5/nsT0isDy56OkSX99sFQbXw.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/firasans/v5/cPT_2ddmoxsUuMtQqa8zGqCWcynf_cDxXwCLxiixG1c.ttf",
    "500italic": "'.cs_server_protocol().'fonts.gstatic.com/s/firasans/v5/6s0YCA9oCTF6hM60YM-qTcCNfqCYlB_eIx7H1TVXe60.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/firasans/v5/6s0YCA9oCTF6hM60YM-qTXe1Pd76Vl7zRpE7NLJQ7XU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Fjalla One",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/fjallaone/v4/3b7vWCfOZsU53vMa8LWsf_esZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Fjord One",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/fjordone/v5/R_YHK8au2uFPw5tNu5N7zw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Flamenco",
   "category": "display",
   "variants": [
    "300",
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/flamenco/v6/x9iI5CogvuZVCGoRHwXuo6CWcynf_cDxXwCLxiixG1c.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/flamenco/v6/HC0ugfLLgt26I5_BWD1PZA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Flavors",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-03",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/flavors/v5/SPJi5QclATvon8ExcKGRvQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Fondamento",
   "category": "handwriting",
   "variants": [
    "regular",
    "italic"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/fondamento/v5/6LWXcjT1B7bnWluAOSNfMPesZW2xOQ-xsNqO47m55DA.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/fondamento/v5/y6TmwhSbZ8rYq7OTFyo7OS3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Fontdiner Swanky",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/fontdinerswanky/v6/8_GxIO5ixMtn5P6COsF3TlBjMPLzPAFJwRBn-s1U7kA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Forum",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "cyrillic-ext",
    "latin-ext",
    "cyrillic",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/forum/v7/MZUpsq1VfLrqv8eSDcbrrQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Francois One",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v9",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/francoisone/v9/bYbkq2nU2TSx4SwFbz5sCC3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Freckle Face",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/freckleface/v4/7-B8j9BPJgazdHIGqPNv8y3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Fredericka the Great",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/frederickathegreat/v5/7Es8Lxoku-e5eOZWpxw18nrnet6gXN1McwdQxS1dVrI.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Fredoka One",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/fredokaone/v4/QKfwXi-z-KtJAlnO2ethYqCWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Freehand",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "khmer"
   ],
   "version": "v8",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/freehand/v8/uEBQxvA0lnn_BrD6krlxMw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Fresca",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/fresca/v5/2q7Qm9sCo1tWvVgSDVWNIw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Frijole",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/frijole/v5/L2MfZse-2gCascuD-nLhWg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Fruktur",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-03",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/fruktur/v6/PnQvfEi1LssAvhJsCwH__w.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Fugaz One",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/fugazone/v6/5tteVDCwxsr8-5RuSiRWOw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "GFS Didot",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "greek"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/gfsdidot/v6/jQKxZy2RU-h9tkPZcRVluA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "GFS Neohellenic",
   "category": "sans-serif",
   "variants": [
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "greek"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/gfsneohellenic/v7/7HwjPQa7qNiOsnUce2h4448_BwCLZY3eDSV6kppAwI8.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/gfsneohellenic/v7/B4xRqbn-tANVqVgamMsSDiayCZa0z7CpFzlkqoCHztc.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/gfsneohellenic/v7/KnaWrO4awITAqigQIIYXKkCTdomiyJpIzPbEbIES3rU.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/gfsneohellenic/v7/FwWjoX6XqT-szJFyqsu_GYFF0fM4h-krcpQk7emtCpE.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Gabriela",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/gabriela/v4/B-2ZfbAO3HDrxqV6lR5tdA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Gafata",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/gafata/v5/aTFqlki_3Dc3geo-FxHTvQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Galdeano",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/galdeano/v6/ZKFMQI6HxEG1jOT0UGSZUg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Galindo",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/galindo/v4/2lafAS_ZEfB33OJryhXDUg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Gentium Basic",
   "category": "serif",
   "variants": [
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/gentiumbasic/v7/2qL6yulgGf0wwgOp-UqGyLNuTeOOLg3nUymsEEGmdO0.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/gentiumbasic/v7/KCktj43blvLkhOTolFn-MYtBLojGU5Qdl8-5NL4v70w.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/gentiumbasic/v7/qoFz4NSMaYC2UmsMAG3lyTj3mvXnCeAk09uTtmkJGRc.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/gentiumbasic/v7/8N9-c_aQDJ8LbI1NGVMrwtswO1vWwP9exiF8s0wqW10.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Gentium Book Basic",
   "category": "serif",
   "variants": [
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/gentiumbookbasic/v6/T2vUYmWzlqUtgLYdlemGnaWESMHIjnSjm9UUxYtEOko.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/gentiumbookbasic/v6/IRFxB2matTxrjZt6a3FUnrWDjKAyldGEr6eEi2MBNeY.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/gentiumbookbasic/v6/qHqW2lwKO8-uTfIkh8FsUfXfjMwrYnmPVsQth2IcAPY.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/gentiumbookbasic/v6/632u7TMIoFDWQYUaHFUp5PA2A9KyRZEkn4TZVuhsWRM.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Geo",
   "category": "sans-serif",
   "variants": [
    "regular",
    "italic"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v8",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/geo/v8/mJuJYk5Pww84B4uHAQ1XaA.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/geo/v8/8_r1wToF7nPdDuX1qxel6Q.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Geostar",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/geostar/v6/A8WQbhQbpYx3GWWaShJ9GA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Geostar Fill",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/geostarfill/v6/Y5ovXPPOHYTfQzK2aM-hui3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Germania One",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/germaniaone/v4/3_6AyUql_-FbDi1e68jHdC3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Gidugu",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "telugu",
    "latin"
   ],
   "version": "v3",
   "lastModified": "2015-04-07",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/gidugu/v3/Ey6Eq3hrT6MM58iFItFcgw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Gilda Display",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/gildadisplay/v4/8yAVUZLLZ3wb7dSsjix0CADHmap7fRWINAsw8-RaxNg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Give You Glory",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/giveyouglory/v6/DFEWZFgGmfseyIdGRJAxuBwwkpSPZdvjnMtysdqprfI.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Glass Antiqua",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/glassantiqua/v4/0yLrXKplgdUDIMz5TnCHNODcg5akpSnIcsPhLOFv7l8.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Glegoo",
   "category": "serif",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "devanagari",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/glegoo/v5/TlLolbauH0-0Aiz1LUH5og.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/glegoo/v5/2tf-h3n2A_SNYXEO0C8bKw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Gloria Hallelujah",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v8",
   "lastModified": "2015-08-14",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/gloriahallelujah/v8/CA1k7SlXcY5kvI81M_R28Q3RdPdyebSUyJECJouPsvA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Goblin One",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/goblinone/v6/331XtzoXgpVEvNTVcBJ_C_esZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Gochi Hand",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/gochihand/v7/KT1-WxgHsittJ34_20IfAPesZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Gorditas",
   "category": "display",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/gorditas/v4/6-XCeknmxaon8AUqVkMnHaCWcynf_cDxXwCLxiixG1c.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/gorditas/v4/uMgZhXUyH6qNGF3QsjQT5Q.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Goudy Bookletter 1911",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/goudybookletter1911/v6/l5lwlGTN3pEY5Bf-rQEuIIjNDsyURsIKu4GSfvSE4mA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Graduate",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/graduate/v4/JpAmYLHqcIh9_Ff35HHwiA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Grand Hotel",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/grandhotel/v4/C_A8HiFZjXPpnMt38XnK7qCWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Gravitas One",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/gravitasone/v6/nBHdBv6zVNU8MtP6w9FwTS3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Great Vibes",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/greatvibes/v4/4Mi5RG_9LjQYrTU55GN_L6CWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Griffy",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/griffy/v4/vWkyYGBSyE5xjnShNtJtzw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Gruppo",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/gruppo/v7/pS_JM0cK_piBZve-lfUq9w.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Gudea",
   "category": "sans-serif",
   "variants": [
    "regular",
    "italic",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/gudea/v4/lsip4aiWhJ9bx172Y9FN_w.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/gudea/v4/S-4QqBlkMPiiA3jNeCR5yw.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/gudea/v4/7mNgsGw_vfS-uUgRVXNDSw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Gurajada",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "telugu",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-07",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/gurajada/v4/6Adfkl4PCRyq6XTENACEyA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Habibi",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/habibi/v5/YYyqXF6pWpL7kmKgS_2iUA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Halant",
   "category": "serif",
   "variants": [
    "300",
    "regular",
    "500",
    "600",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "devanagari",
    "latin"
   ],
   "version": "v1",
   "lastModified": "2015-04-01",
   "files": {
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/halant/v1/dM3ItAOWNNod_Cf3MnLlEg.ttf",
    "500": "'.cs_server_protocol().'fonts.gstatic.com/s/halant/v1/tlsNj3K-hJKtiirTDtUbkQ.ttf",
    "600": "'.cs_server_protocol().'fonts.gstatic.com/s/halant/v1/zNR2WvI_V8o652vIZp3X4Q.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/halant/v1/D9FN7OH89AuCmZDLHbPQfA.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/halant/v1/rEs7Jk3SVyt3cTx6DoTu1w.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Hammersmith One",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/hammersmithone/v7/FWNn6ITYqL6or7ZTmBxRhjjVlsJB_M_Q_LtZxsoxvlw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Hanalei",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-03",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/hanalei/v6/Sx8vVMBnXSQyK6Cn0CBJ3A.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Hanalei Fill",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-03",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/hanaleifill/v5/5uPeWLnaDdtm4UBG26Ds6C3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Handlee",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/handlee/v5/6OfkXkyC0E5NZN80ED8u3A.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Hanuman",
   "category": "serif",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "khmer"
   ],
   "version": "v9",
   "lastModified": "2015-08-26",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/hanuman/v9/lzzXZ2l84x88giDrbfq76vesZW2xOQ-xsNqO47m55DA.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/hanuman/v9/hRhwOGGmElJSl6KSPvEnOQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Happy Monkey",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/happymonkey/v5/c2o0ps8nkBmaOYctqBq1rS3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Headland One",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/headlandone/v4/iGmBeOvQGfq9DSbjJ8jDVy3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Henny Penny",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/hennypenny/v4/XRgo3ogXyi3tpsFfjImRF6CWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Herr Von Muellerhoff",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/herrvonmuellerhoff/v6/mmy24EUmk4tjm4gAEjUd7NLGIYrUsBdh-JWHYgiDiMU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Hind",
   "category": "sans-serif",
   "variants": [
    "300",
    "regular",
    "500",
    "600",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "devanagari",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/hind/v5/qa346Adgv9kPDXoD1my4kA.ttf",
    "500": "'.cs_server_protocol().'fonts.gstatic.com/s/hind/v5/2cs8RCVcYtiv4iNDH1UsQQ.ttf",
    "600": "'.cs_server_protocol().'fonts.gstatic.com/s/hind/v5/TUKUmFMXSoxloBP1ni08oA.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/hind/v5/cXJJavLdUbCfjxlsA6DqTw.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/hind/v5/mktFHh5Z5P9YjGKSslSUtA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Holtwood One SC",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/holtwoodonesc/v7/sToOq3cIxbfnhbEkgYNuBbAgSRh1LpJXlLfl8IbsmHg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Homemade Apple",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/homemadeapple/v6/yg3UMEsefgZ8IHz_ryz86BiPOmFWYV1WlrJkRafc4c0.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Homenaje",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/homenaje/v5/v0YBU0iBRrGdVjDNQILxtA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "IM Fell DW Pica",
   "category": "serif",
   "variants": [
    "regular",
    "italic"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/imfelldwpica/v6/W81bfaWiUicLSPbJhW-ATsA5qm663gJGVdtpamafG5A.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/imfelldwpica/v6/alQJ8SK5aSOZVaelYoyT4PL2asmh5DlYQYCosKo6yQs.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "IM Fell DW Pica SC",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/imfelldwpicasc/v6/xBKKJV4z2KsrtQnmjGO17JZ9RBdEL0H9o5qzT1Rtof4.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "IM Fell Double Pica",
   "category": "serif",
   "variants": [
    "regular",
    "italic"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/imfelldoublepica/v6/yN1wY_01BkQnO0LYAhXdUol14jEdVOhEmvtCMCVwYak.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/imfelldoublepica/v6/64odUh2hAw8D9dkFKTlWYq0AWwkgdQfsRHec8TYi4mI.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "IM Fell Double Pica SC",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/imfelldoublepicasc/v6/jkrUtrLFpMw4ZazhfkKsGwc4LoC4OJUqLw9omnT3VOU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "IM Fell English",
   "category": "serif",
   "variants": [
    "regular",
    "italic"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/imfellenglish/v6/xwIisCqGFi8pff-oa9uSVHGNmx1fDm-u2eBJHQkdrmk.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/imfellenglish/v6/Z3cnIAI_L3XTRfz4JuZKbuewladMPCWTthtMv9cPS-c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "IM Fell English SC",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/imfellenglishsc/v6/h3Tn6yWfw4b5qaLD1RWvz5ATixNthKRRR1XVH3rJNiw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "IM Fell French Canon",
   "category": "serif",
   "variants": [
    "regular",
    "italic"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/imfellfrenchcanon/v6/iKB0WL1BagSpNPz3NLMdsJ3V2FNpBrlLSvqUnERhBP8.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/imfellfrenchcanon/v6/owCuNQkLLFW7TBBPJbMnhRa-QL94KdW80H29tcyld2A.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "IM Fell French Canon SC",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/imfellfrenchcanonsc/v6/kA3bS19-tQbeT_iG32EZmaiyyzHwYrAbmNulTz423iM.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "IM Fell Great Primer",
   "category": "serif",
   "variants": [
    "regular",
    "italic"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/imfellgreatprimer/v6/AL8ALGNthei20f9Cu3e93rgeX3ROgtTz44CitKAxzKI.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/imfellgreatprimer/v6/1a-artkXMVg682r7TTxVY1_YG2SFv8Ma7CxRl1S3o7g.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "IM Fell Great Primer SC",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/imfellgreatprimersc/v6/A313vRj97hMMGFjt6rgSJtRg-ciw1Y27JeXb2Zv4lZQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Iceberg",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/iceberg/v4/p2XVm4M-N0AOEEOymFKC5w.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Iceland",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/iceland/v5/kq3uTMGgvzWGNi39B_WxGA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Imprima",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/imprima/v4/eRjquWLjwLGnTEhLH7u3kA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Inconsolata",
   "category": "monospace",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v11",
   "lastModified": "2015-05-14",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/inconsolata/v11/AIed271kqQlcIRSOnQH0yXe1Pd76Vl7zRpE7NLJQ7XU.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/inconsolata/v11/7bMKuoy6Nh0ft0SHnIGMuaCWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Inder",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/inder/v5/C38TwecLTfKxIHDc_Adcrw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Indie Flower",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v8",
   "lastModified": "2015-08-14",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/indieflower/v8/10JVD_humAd5zP2yrFqw6i3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Inika",
   "category": "serif",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/inika/v4/bl3ZoTyrWsFun2zYbsgJrA.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/inika/v4/eZCrULQGaIxkrRoGz_DjhQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Inknut Antiqua",
   "category": "serif",
   "variants": [
    "300",
    "regular",
    "500",
    "600",
    "700",
    "800",
    "900"
   ],
   "subsets": [
    "latin-ext",
    "devanagari",
    "latin"
   ],
   "version": "v1",
   "lastModified": "2015-06-11",
   "files": {
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/inknutantiqua/v1/CagoW52rBcslcXzHh6tVIg6hmPNSXwHGnJQCeQHKUMo.ttf",
    "500": "'.cs_server_protocol().'fonts.gstatic.com/s/inknutantiqua/v1/CagoW52rBcslcXzHh6tVIiYCDvi1XFzRnTV7qUFsNgk.ttf",
    "600": "'.cs_server_protocol().'fonts.gstatic.com/s/inknutantiqua/v1/CagoW52rBcslcXzHh6tVIjLEgY6PI0GrY6L00mykcEQ.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/inknutantiqua/v1/CagoW52rBcslcXzHh6tVIlRhfXn9P4_QueZ7VkUHUNc.ttf",
    "800": "'.cs_server_protocol().'fonts.gstatic.com/s/inknutantiqua/v1/CagoW52rBcslcXzHh6tVInARjXVu2t2krcNTHiCb1qY.ttf",
    "900": "'.cs_server_protocol().'fonts.gstatic.com/s/inknutantiqua/v1/CagoW52rBcslcXzHh6tVIrTsNy1JrFNT1qKy8j7W3CU.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/inknutantiqua/v1/VlmmTfOrxr3HfcnhMueX9arFJ4O13IHVxZbM6yoslpo.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Irish Grover",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/irishgrover/v6/kUp7uUPooL-KsLGzeVJbBC3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Istok Web",
   "category": "sans-serif",
   "variants": [
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "cyrillic-ext",
    "latin-ext",
    "cyrillic",
    "latin"
   ],
   "version": "v10",
   "lastModified": "2015-06-11",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/istokweb/v10/2koEo4AKFSvK4B52O_Mwai3USBnSvpkopQaUR-2r7iU.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/istokweb/v10/RYLSjEXQ0nNtLLc4n7--dQ.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/istokweb/v10/kvcT2SlTjmGbC3YlZxmrl6CWcynf_cDxXwCLxiixG1c.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/istokweb/v10/ycQ3g52ELrh3o_HYCNNUw3e1Pd76Vl7zRpE7NLJQ7XU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Italiana",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/italiana/v4/dt95fkCSTOF-c6QNjwSycA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Italianno",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/italianno/v6/HsyHnLpKf8uP7aMpDQHZmg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Itim",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "vietnamese",
    "thai",
    "latin"
   ],
   "version": "v1",
   "lastModified": "2015-08-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/itim/v1/HHV9WK2x5lUkc5bxMXG8Tw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Jacques Francois",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/jacquesfrancois/v4/_-0XWPQIW6tOzTHg4KaJ_M13D_4KM32Q4UmTSjpuNGQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Jacques Francois Shadow",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/jacquesfrancoisshadow/v4/V14y0H3vq56fY9SV4OL_FASt0D_oLVawA8L8b9iKjbs.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Jaldi",
   "category": "sans-serif",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "devanagari",
    "latin"
   ],
   "version": "v2",
   "lastModified": "2015-06-10",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/jaldi/v2/OIbtgjjEp3aVWtjF6WY8mA.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/jaldi/v2/x1vR-bPW9a1EB-BUVqttCw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Jim Nightshade",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-03",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/jimnightshade/v4/_n43lYHXVWNgXegdYRIK9CF1W_bo0EdycfH0kHciIic.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Jockey One",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/jockeyone/v6/cAucnOZLvFo07w2AbufBCfesZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Jolly Lodger",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/jollylodger/v4/RX8HnkBgaEKQSHQyP9itiS3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Josefin Sans",
   "category": "sans-serif",
   "variants": [
    "100",
    "100italic",
    "300",
    "300italic",
    "regular",
    "italic",
    "600",
    "600italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v9",
   "lastModified": "2015-04-06",
   "files": {
    "100": "'.cs_server_protocol().'fonts.gstatic.com/s/josefinsans/v9/q9w3H4aeBxj0hZ8Osfi3d8SVQ0giZ-l_NELu3lgGyYw.ttf",
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/josefinsans/v9/C6HYlRF50SGJq1XyXj04z6cQoVhARpoaILP7amxE_8g.ttf",
    "600": "'.cs_server_protocol().'fonts.gstatic.com/s/josefinsans/v9/C6HYlRF50SGJq1XyXj04z2v8CylhIUtwUiYO7Z2wXbE.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/josefinsans/v9/C6HYlRF50SGJq1XyXj04z0D2ttfZwueP-QU272T9-k4.ttf",
    "100italic": "'.cs_server_protocol().'fonts.gstatic.com/s/josefinsans/v9/s7-P1gqRNRNn-YWdOYnAOXXcj1rQwlNLIS625o-SrL0.ttf",
    "300italic": "'.cs_server_protocol().'fonts.gstatic.com/s/josefinsans/v9/ppse0J9fKSaoxCIIJb33Gyna0FLWfcB-J_SAYmcAXaI.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/josefinsans/v9/xgzbb53t8j-Mo-vYa23n5i3USBnSvpkopQaUR-2r7iU.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/josefinsans/v9/q9w3H4aeBxj0hZ8Osfi3d_MZXuCXbOrAvx5R0IT5Oyo.ttf",
    "600italic": "'.cs_server_protocol().'fonts.gstatic.com/s/josefinsans/v9/ppse0J9fKSaoxCIIJb33G4R-5-urNOGAobhAyctHvW8.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/josefinsans/v9/ppse0J9fKSaoxCIIJb33G_As9-1nE9qOqhChW0m4nDE.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Josefin Slab",
   "category": "serif",
   "variants": [
    "100",
    "100italic",
    "300",
    "300italic",
    "regular",
    "italic",
    "600",
    "600italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "100": "'.cs_server_protocol().'fonts.gstatic.com/s/josefinslab/v6/etsUjZYO8lTLU85lDhZwUsSVQ0giZ-l_NELu3lgGyYw.ttf",
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/josefinslab/v6/NbE6ykYuM2IyEwxQxOIi2KcQoVhARpoaILP7amxE_8g.ttf",
    "600": "'.cs_server_protocol().'fonts.gstatic.com/s/josefinslab/v6/NbE6ykYuM2IyEwxQxOIi2Gv8CylhIUtwUiYO7Z2wXbE.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/josefinslab/v6/NbE6ykYuM2IyEwxQxOIi2ED2ttfZwueP-QU272T9-k4.ttf",
    "100italic": "'.cs_server_protocol().'fonts.gstatic.com/s/josefinslab/v6/8BjDChqLgBF3RJKfwHIYh3Xcj1rQwlNLIS625o-SrL0.ttf",
    "300italic": "'.cs_server_protocol().'fonts.gstatic.com/s/josefinslab/v6/af9sBoKGPbGO0r21xJulyyna0FLWfcB-J_SAYmcAXaI.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/josefinslab/v6/46aYWdgz-1oFX11flmyEfS3USBnSvpkopQaUR-2r7iU.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/josefinslab/v6/etsUjZYO8lTLU85lDhZwUvMZXuCXbOrAvx5R0IT5Oyo.ttf",
    "600italic": "'.cs_server_protocol().'fonts.gstatic.com/s/josefinslab/v6/af9sBoKGPbGO0r21xJuly4R-5-urNOGAobhAyctHvW8.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/josefinslab/v6/af9sBoKGPbGO0r21xJuly_As9-1nE9qOqhChW0m4nDE.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Joti One",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/jotione/v4/P3r_Th0ESHJdzunsvWgUfQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Judson",
   "category": "serif",
   "variants": [
    "regular",
    "italic",
    "700"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/judson/v7/he4a2LwiPJc7r8x0oKCKiA.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/judson/v7/znM1AAs0eytUaJzf1CrYZQ.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/judson/v7/GVqQW9P52ygW-ySq-CLwAA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Julee",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/julee/v6/CAib-jsUsSO8SvVRnE9fHA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Julius Sans One",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-22",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/juliussansone/v5/iU65JP9acQHPDLkdalCF7jjVlsJB_M_Q_LtZxsoxvlw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Junge",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/junge/v4/j4IXCXtxrw9qIBheercp3A.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Jura",
   "category": "sans-serif",
   "variants": [
    "300",
    "regular",
    "500",
    "600"
   ],
   "subsets": [
    "cyrillic-ext",
    "greek",
    "latin-ext",
    "cyrillic",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/jura/v7/Rqx_xy1UnN0C7wD3FUSyPQ.ttf",
    "500": "'.cs_server_protocol().'fonts.gstatic.com/s/jura/v7/16xhfjHCiaLj3tsqqgmtGg.ttf",
    "600": "'.cs_server_protocol().'fonts.gstatic.com/s/jura/v7/iwseduOwJSdY8wQ1Y6CJdA.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/jura/v7/YAWMwF3sN0KCbynMq-Yr_Q.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Just Another Hand",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/justanotherhand/v7/fKV8XYuRNNagXr38eqbRf99BnJIEGrvoojniP57E51c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Just Me Again Down Here",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v8",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/justmeagaindownhere/v8/sN06iTc9ITubLTgXoG-kc3M9eVLpVTSK6TqZTIgBrWQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Kadwa",
   "category": "serif",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "devanagari",
    "latin"
   ],
   "version": "v1",
   "lastModified": "2015-06-17",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/kadwa/v1/NFPZaBfekj_Io-7vUMz4Ww.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/kadwa/v1/VwEN8oKGqaa0ug9kRpvSSg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Kalam",
   "category": "handwriting",
   "variants": [
    "300",
    "regular",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "devanagari",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-08-06",
   "files": {
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/kalam/v7/MgQQlk1SgPEHdlkWMNh7Jg.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/kalam/v7/95nLItUGyWtNLZjSckluLQ.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/kalam/v7/hNEJkp2K-aql7e5WQish4Q.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Kameron",
   "category": "serif",
   "variants": [
    "regular",
    "700"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/kameron/v7/rabVVbzlflqvmXJUFlKnu_esZW2xOQ-xsNqO47m55DA.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/kameron/v7/9r8HYhqDSwcq9WMjupL82A.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Kantumruy",
   "category": "sans-serif",
   "variants": [
    "300",
    "regular",
    "700"
   ],
   "subsets": [
    "khmer"
   ],
   "version": "v3",
   "lastModified": "2015-04-03",
   "files": {
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/kantumruy/v3/ERRwQE0WG5uanaZWmOFXNi3USBnSvpkopQaUR-2r7iU.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/kantumruy/v3/gie_zErpGf_rNzs920C2Ji3USBnSvpkopQaUR-2r7iU.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/kantumruy/v3/kQfXNYElQxr5dS8FyjD39Q.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Karla",
   "category": "sans-serif",
   "variants": [
    "regular",
    "italic",
    "700",
    "700italic"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/karla/v5/JS501sZLxZ4zraLQdncOUA.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/karla/v5/78UgGRwJFkhqaoFimqoKpQ.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/karla/v5/51UBKly9RQOnOkj95ZwEFw.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/karla/v5/3YDyi09gQjCRh-5-SVhTTvesZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Karma",
   "category": "serif",
   "variants": [
    "300",
    "regular",
    "500",
    "600",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "devanagari",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/karma/v5/lH6ijJnguWR2Sz7tEl6MQQ.ttf",
    "500": "'.cs_server_protocol().'fonts.gstatic.com/s/karma/v5/9YGjxi6Hcvz2Kh-rzO_cAw.ttf",
    "600": "'.cs_server_protocol().'fonts.gstatic.com/s/karma/v5/h_CVzXXtqSxjfS2sIwaejA.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/karma/v5/smuSM08oApsQPPVYbHd1CA.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/karma/v5/wvqTxAGBUrTqU0urTEoPIw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Kaushan Script",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/kaushanscript/v4/qx1LSqts-NtiKcLw4N03IBnpV0hQCek3EmWnCPrvGRM.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Kavoon",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/kavoon/v4/382m-6baKXqJFQjEgobt6Q.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Kdam Thmor",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "khmer"
   ],
   "version": "v3",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/kdamthmor/v3/otCdP6UU-VBIrBfVDWBQJ_esZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Keania One",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/keaniaone/v4/PACrDKZWngXzgo-ucl6buvesZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Kelly Slab",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "cyrillic",
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/kellyslab/v6/F_2oS1e9XdYx1MAi8XEVefesZW2xOQ-xsNqO47m55DA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Kenia",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v8",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/kenia/v8/OLM9-XfITK9PsTLKbGBrwg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Khand",
   "category": "sans-serif",
   "variants": [
    "300",
    "regular",
    "500",
    "600",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "devanagari",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/khand/v4/072zRl4OU9Pinjjkg174LA.ttf",
    "500": "'.cs_server_protocol().'fonts.gstatic.com/s/khand/v4/46_p-SqtuMe56nxQdteWxg.ttf",
    "600": "'.cs_server_protocol().'fonts.gstatic.com/s/khand/v4/zggGWYIiPJyMTgkfxP_kaA.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/khand/v4/0I0UWaN-X5QBmfexpXKhqg.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/khand/v4/HdLdTNFqNIDGJZl1ZEj84w.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Khmer",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "khmer"
   ],
   "version": "v9",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/khmer/v9/vWaBJIbaQuBNz02ALIKJ3A.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Khula",
   "category": "sans-serif",
   "variants": [
    "300",
    "regular",
    "600",
    "700",
    "800"
   ],
   "subsets": [
    "latin-ext",
    "devanagari",
    "latin"
   ],
   "version": "v1",
   "lastModified": "2015-04-06",
   "files": {
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/khula/v1/_1LySU5Upq-sc4OZ1b_GIw.ttf",
    "600": "'.cs_server_protocol().'fonts.gstatic.com/s/khula/v1/4ZH86Hce-aeFDaedTnbkbg.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/khula/v1/UGVExGl-Jjs-YPpGv-MZ6w.ttf",
    "800": "'.cs_server_protocol().'fonts.gstatic.com/s/khula/v1/Sccp_oOo8FWgbx5smie7xQ.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/khula/v1/izcPIFyCSd16XI1Ak_Wk7Q.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Kite One",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/kiteone/v4/8ojWmgUc97m0f_i6sTqLoQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Knewave",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v5",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/knewave/v5/KGHM4XWr4iKnBMqzZLkPBg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Kotta One",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/kottaone/v4/AB2Q7hVw6niJYDgLvFXu5w.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Koulen",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "khmer"
   ],
   "version": "v10",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/koulen/v10/AAYOK8RSRO7FTskTzFuzNw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Kranky",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/kranky/v6/C8dxxTS99-fZ84vWk8SDrg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Kreon",
   "category": "serif",
   "variants": [
    "300",
    "regular",
    "700"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v9",
   "lastModified": "2015-04-06",
   "files": {
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/kreon/v9/HKtJRiq5C2zbq5N1IX32sA.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/kreon/v9/jh0dSmaPodjxISiblIUTkw.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/kreon/v9/zA_IZt0u0S3cvHJu-n1oEg.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Kristi",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/kristi/v7/aRsgBQrkQkMlu4UPSnJyOQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Krona One",
   "category": "sans-serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/kronaone/v4/zcQj4ljqTo166AdourlF9w.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Kurale",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "cyrillic",
    "devanagari",
    "latin"
   ],
   "version": "v1",
   "lastModified": "2015-05-14",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/kurale/v1/rxeyIcvQlT4XAWwNbXFCfw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "La Belle Aurore",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-08-12",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/labelleaurore/v7/Irdbc4ASuUoWDjd_Wc3md123K2iuuhwZgaKapkyRTY8.ttf"
   }


  },
  {
   "kind": "webfonts#webfont",
   "family": "Laila",
   "category": "serif",
   "variants": [
    "300",
    "regular",
    "500",
    "600",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "devanagari",
    "latin"
   ],
   "version": "v1",
   "lastModified": "2015-04-01",
   "files": {
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/laila/v1/bLbIVEZF3IWSZ-in72GJvA.ttf",
    "500": "'.cs_server_protocol().'fonts.gstatic.com/s/laila/v1/tkf8VtFvW9g3VsxQCA6WOQ.ttf",
    "600": "'.cs_server_protocol().'fonts.gstatic.com/s/laila/v1/3EMP2L6JRQ4GaHIxCldCeA.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/laila/v1/R7P4z1xjcjecmjZ9GyhqHQ.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/laila/v1/6iYor3edprH7360qtBGoag.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Lakki Reddy",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "telugu",
    "latin"
   ],
   "version": "v3",
   "lastModified": "2015-04-03",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/lakkireddy/v3/Q5EpFa91FjW37t0FCnedaKCWcynf_cDxXwCLxiixG1c.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Lancelot",
   "category": "display",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v6",
   "lastModified": "2015-08-12",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/lancelot/v6/XMT7T_oo_MQUGAnU2v-sdA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Lateef",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "arabic",
    "latin"
   ],
   "version": "v10",
   "lastModified": "2015-04-07",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/lateef/v10/PAsKCgi1qc7XPwvzo_I-DQ.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Lato",
   "category": "sans-serif",
   "variants": [
    "100",
    "100italic",
    "300",
    "300italic",
    "regular",
    "italic",
    "700",
    "700italic",
    "900",
    "900italic"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v11",
   "lastModified": "2015-04-06",
   "files": {
    "100": "'.cs_server_protocol().'fonts.gstatic.com/s/lato/v11/Upp-ka9rLQmHYCsFgwL-eg.ttf",
    "300": "'.cs_server_protocol().'fonts.gstatic.com/s/lato/v11/Ja02qOppOVq9jeRjWekbHg.ttf",
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/lato/v11/iX_QxBBZLhNj5JHlTzHQzg.ttf",
    "900": "'.cs_server_protocol().'fonts.gstatic.com/s/lato/v11/8TPEV6NbYWZlNsXjbYVv7w.ttf",
    "100italic": "'.cs_server_protocol().'fonts.gstatic.com/s/lato/v11/zLegi10uS_9-fnUDISl0KA.ttf",
    "300italic": "'.cs_server_protocol().'fonts.gstatic.com/s/lato/v11/dVebFcn7EV7wAKwgYestUg.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/lato/v11/h7rISIcQapZBpei-sXwIwg.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/lato/v11/P_dJOFJylV3A870UIOtr0w.ttf",
    "700italic": "'.cs_server_protocol().'fonts.gstatic.com/s/lato/v11/WFcZakHrrCKeUJxHA4T_gw.ttf",
    "900italic": "'.cs_server_protocol().'fonts.gstatic.com/s/lato/v11/draWperrI7n2xi35Cl08fA.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "League Script",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/leaguescript/v7/wnRFLvfabWK_DauqppD6vSeUSrabuTpOsMEiRLtKwk0.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Leckerli One",
   "category": "handwriting",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/leckerlione/v7/S2Y_iLrItTu8kIJTkS7DrC3USBnSvpkopQaUR-2r7iU.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Ledger",
   "category": "serif",
   "variants": [
    "regular"
   ],
   "subsets": [
    "latin-ext",
    "cyrillic",
    "latin"
   ],
   "version": "v4",
   "lastModified": "2015-04-06",
   "files": {
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/ledger/v4/G432jp-tahOfWHbCYkI0jw.ttf"
   }
  },
  {
   "kind": "webfonts#webfont",
   "family": "Lekton",
   "category": "sans-serif",
   "variants": [
    "regular",
    "italic",
    "700"
   ],
   "subsets": [
    "latin-ext",
    "latin"
   ],
   "version": "v7",
   "lastModified": "2015-04-06",
   "files": {
    "700": "'.cs_server_protocol().'fonts.gstatic.com/s/lekton/v7/WZw-uL8WTkx3SBVfTlevXQ.ttf",
    "regular": "'.cs_server_protocol().'fonts.gstatic.com/s/lekton/v7/r483JYmxf5PjIm4jVAm8Yg.ttf",
    "italic": "'.cs_server_protocol().'fonts.gstatic.com/s/lekton/v7/_UbDIPBA1wDqSbhp-OED7A.ttf"
   }
  },';
 