AmCharts.AmFunnelChart=AmCharts.Class({inherits:AmCharts.AmSlicedChart,construct:function(g){this.type="funnel";AmCharts.AmFunnelChart.base.construct.call(this,g);this.cname="AmFunnelChart";this.startX=this.startY=0;this.baseWidth="100%";this.neckHeight=this.neckWidth=0;this.rotate=!1;this.valueRepresents="height";this.pullDistance=30;this.labelPosition="center";this.labelText="[[title]]: [[value]]";this.balloonText="[[title]]: [[value]]\n[[description]]";AmCharts.applyTheme(this,g,this.cname)},drawChart:function(){AmCharts.AmFunnelChart.base.drawChart.call(this);
var g=this.chartData;if(AmCharts.ifArray(g))if(0<this.realWidth&&0<this.realHeight){var d=Math.round(this.depth3D*Math.cos(this.angle*Math.PI/180)),a=Math.round(-this.depth3D*Math.sin(this.angle*Math.PI/180)),b=this.container,n=this.startDuration,e=this.rotate,u=this.updateWidth();this.realWidth=u;var f=this.updateHeight();this.realHeight=f;var l=AmCharts.toCoordinate,s=l(this.marginLeft,u),p=l(this.marginRight,u),c=l(this.marginTop,f)+this.getTitleHeight(),l=l(this.marginBottom,f);0<d&&0>a&&(this.neckHeight=
this.neckWidth=0,e?l-=a/2:c-=a/2);var p=u-s-p,E=AmCharts.toCoordinate(this.baseWidth,p),C=AmCharts.toCoordinate(this.neckWidth,p),F=f-l-c,y=AmCharts.toCoordinate(this.neckHeight,F),w=c+F-y;e&&(c=f-l,w=c-F+y);this.firstSliceY=c;AmCharts.VML&&(this.startAlpha=1);for(var q=p/2+s,D=(F-y)/((E-C)/2),H=1,z=E/2,E=(F-y)*(E+C)/2+C*y,G=c,I=0,y=0;y<g.length;y++){var h=g[y],m;if(!0!==h.hidden){var A=[],t=[],k;if("height"==this.valueRepresents)k=F*h.percents/100;else{var r=-E*h.percents/100/2,B=z;m=-1/(2*D);k=
Math.pow(B,2)-4*m*r;0>k&&(k=0);k=(Math.sqrt(k)-B)/(2*m);if(!e&&c>=w||e&&c<=w)k=2*-r/C;else if(!e&&c+k>w||e&&c-k<w)m=e?Math.round(k+(c-k-w)):Math.round(k-(c+k-w)),k=m/D,k=m+2*(-r-(B-k/2)*m)/C}r=z-k/D;B=!1;!e&&c+k>w||e&&c-k<w?(r=C/2,A.push(q-z,q+z,q+r,q+r,q-r,q-r),e?(m=k+(c-k-w),c<w&&(m=0),t.push(c,c,c-m,c-k,c-k,c-m,c)):(m=k-(c+k-w),c>w&&(m=0),t.push(c,c,c+m,c+k,c+k,c+m,c)),B=!0):(A.push(q-z,q+z,q+r,q-r),e?t.push(c,c,c-k,c-k):t.push(c,c,c+k,c+k));b.set();m=b.set();0<d&&0>a?(A=r/z,t=-1,e||(t=1),wedgeGraphics=
(new AmCharts.Cuboid(b,2*z,t*k,d,a*H,h.color,h.alpha,this.outlineThickness,this.outlineColor,this.outlineAlpha,90,0,!1,0,h.pattern,A)).set,wedgeGraphics.translate(q-z,c-a/2*H),H*=A):wedgeGraphics=AmCharts.polygon(b,A,t,h.color,h.alpha,this.outlineThickness,this.outlineColor,this.outlineAlpha);m.push(wedgeGraphics);this.graphsSet.push(m);e||m.toBack();h.wedge=m;h.index=y;if(A=this.gradientRatio){var t=[],v;for(v=0;v<A.length;v++)t.push(AmCharts.adjustLuminosity(h.color,A[v]));0<t.length&&wedgeGraphics.gradient("linearGradient",
t);h.pattern&&wedgeGraphics.pattern(h.pattern)}0<n&&(this.chartCreated||m.setAttr("opacity",this.startAlpha));this.addEventListeners(m,h);h.ty0=c-k/2;if(this.labelsEnabled&&this.labelText&&h.percents>=this.hideLabelsPercent){t=this.formatString(this.labelText,h);(A=this.labelFunction)&&(t=A(h,t));v=h.labelColor;v||(v=this.color);var A=this.labelPosition,x="left";"center"==A&&(x="middle");"left"==A&&(x="right");t=AmCharts.wrappedText(b,t,v,this.fontFamily,this.fontSize,x,!1,this.maxLabelWidth);t.node.style.pointerEvents=
"none";m.push(t);v=q;e?(x=c-k/2,h.ty0=x):(x=c+k/2,h.ty0=x,x<G+I+5&&(x=G+I+5),x>f-l&&(x=f-l));"right"==A&&(v=p+10+s,h.tx0=q+(z-k/2/D),B&&(h.tx0=q+r));"left"==A&&(h.tx0=q-(z-k/2/D),B&&(h.tx0=q-r),v=s);h.label=t;h.labelX=v;h.labelY=x;h.labelHeight=t.getBBox().height;t.translate(v,x);z=t.getBBox();G=AmCharts.rect(b,z.width+5,z.height+5,"#ffffff",.005);G.translate(v+z.x,x+z.y);m.push(G);h.hitRect=G;I=t.getBBox().height;G=x}(0===h.alpha||0<n&&!this.chartCreated)&&m.hide();c=e?c-k:c+k;z=r;h.startX=AmCharts.toCoordinate(this.startX,
u);h.startY=AmCharts.toCoordinate(this.startY,f);h.pullX=AmCharts.toCoordinate(this.pullDistance,u);h.pullY=0;h.balloonX=q;h.balloonY=h.ty0}}this.arrangeLabels();this.initialStart();(g=this.legend)&&g.invalidateSize()}else this.cleanChart();this.dispDUpd();this.chartCreated=!0},arrangeLabels:function(){var g=this.rotate,d;d=g?0:this.realHeight;for(var a=0,b=this.chartData,n=b.length,e,u=0;u<n;u++){e=b[n-u-1];var f=e.label,l=e.labelY,s=e.labelX,p=e.labelHeight,c=l;g?d+a+5>l&&(c=d+a+5):l+p+5>d&&(c=
d-5-p);d=c;a=p;if(f){f.translate(s,c);var E=f.getBBox()}e.hitRect.translate(s+E.x,c+E.y);e.labelY=c;e.tx=s;e.ty=c;e.tx2=s}"center"!=this.labelPosition&&this.drawTicks()}});AmCharts.Cuboid=AmCharts.Class({construct:function(g,d,a,b,n,e,u,f,l,s,p,c,E,C,F,y){this.set=g.set();this.container=g;this.h=Math.round(a);this.w=Math.round(d);this.dx=b;this.dy=n;this.colors=e;this.alpha=u;this.bwidth=f;this.bcolor=l;this.balpha=s;this.dashLength=C;this.topRadius=y;this.pattern=F;(this.rotate=E)?0>d&&0===p&&(p=180):0>a&&270==p&&(p=90);this.gradientRotation=p;0===b&&0===n&&(this.cornerRadius=c);this.draw()},draw:function(){var g=this.set;g.clear();var d=this.container,a=this.w,b=
this.h,n=this.dx,e=this.dy,u=this.colors,f=this.alpha,l=this.bwidth,s=this.bcolor,p=this.balpha,c=this.gradientRotation,E=this.cornerRadius,C=this.dashLength,F=this.pattern,y=this.topRadius,w=u,q=u;"object"==typeof u&&(w=u[0],q=u[u.length-1]);var D,H,z,G,I,h,m,A,t,k=f;F&&(f=0);var r,B,v,x,J=this.rotate;if(0<Math.abs(n)||0<Math.abs(e))if(isNaN(y))m=q,q=AmCharts.adjustLuminosity(w,-.2),q=AmCharts.adjustLuminosity(w,-.2),D=AmCharts.polygon(d,[0,n,a+n,a,0],[0,e,e,0,0],q,f,1,s,0,c),0<p&&(t=AmCharts.line(d,
[0,n,a+n],[0,e,e],s,p,l,C)),H=AmCharts.polygon(d,[0,0,a,a,0],[0,b,b,0,0],q,f,1,s,0,c),H.translate(n,e),0<p&&(z=AmCharts.line(d,[n,n],[e,e+b],s,p,l,C)),G=AmCharts.polygon(d,[0,0,n,n,0],[0,b,b+e,e,0],q,f,1,s,0,c),I=AmCharts.polygon(d,[a,a,a+n,a+n,a],[0,b,b+e,e,0],q,f,1,s,0,c),0<p&&(h=AmCharts.line(d,[a,a+n,a+n,a],[0,e,b+e,b],s,p,l,C)),q=AmCharts.adjustLuminosity(m,.2),m=AmCharts.polygon(d,[0,n,a+n,a,0],[b,b+e,b+e,b,b],q,f,1,s,0,c),0<p&&(A=AmCharts.line(d,[0,n,a+n],[b,b+e,b+e],s,p,l,C));else{var K,L,
M;J?(K=b/2,q=n/2,M=b/2,L=a+n/2,B=Math.abs(b/2),r=Math.abs(n/2)):(q=a/2,K=e/2,L=a/2,M=b+e/2+1,r=Math.abs(a/2),B=Math.abs(e/2));v=r*y;x=B*y;.1<r&&.1<r&&(D=AmCharts.circle(d,r,w,f,l,s,p,!1,B),D.translate(q,K));.1<v&&.1<v&&(m=AmCharts.circle(d,v,AmCharts.adjustLuminosity(w,.5),f,l,s,p,!1,x),m.translate(L,M))}f=k;1>Math.abs(b)&&(b=0);1>Math.abs(a)&&(a=0);!isNaN(y)&&(0<Math.abs(n)||0<Math.abs(e))?(u=[w],u={fill:u,stroke:s,"stroke-width":l,"stroke-opacity":p,"fill-opacity":f},J?(f="M0,0 L"+a+","+(b/2-b/
2*y),l=" B",0<a&&(l=" A"),AmCharts.VML?(f+=l+Math.round(a-v)+","+Math.round(b/2-x)+","+Math.round(a+v)+","+Math.round(b/2+x)+","+a+",0,"+a+","+b,f=f+(" L0,"+b)+(l+Math.round(-r)+","+Math.round(b/2-B)+","+Math.round(r)+","+Math.round(b/2+B)+",0,"+b+",0,0")):(f+="A"+v+","+x+",0,0,0,"+a+","+(b-b/2*(1-y))+"L0,"+b,f+="A"+r+","+B+",0,0,1,0,0"),r=90):(l=a/2-a/2*y,f="M0,0 L"+l+","+b,AmCharts.VML?(f="M0,0 L"+l+","+b,l=" B",0>b&&(l=" A"),f+=l+Math.round(a/2-v)+","+Math.round(b-x)+","+Math.round(a/2+v)+","+
Math.round(b+x)+",0,"+b+","+a+","+b,f+=" L"+a+",0",f+=l+Math.round(a/2+r)+","+Math.round(B)+","+Math.round(a/2-r)+","+Math.round(-B)+","+a+",0,0,0"):(f+="A"+v+","+x+",0,0,0,"+(a-a/2*(1-y))+","+b+"L"+a+",0",f+="A"+r+","+B+",0,0,1,0,0"),r=180),d=d.path(f).attr(u),d.gradient("linearGradient",[w,AmCharts.adjustLuminosity(w,-.3),AmCharts.adjustLuminosity(w,-.3),w],r),J?d.translate(n/2,0):d.translate(0,e/2)):d=0===b?AmCharts.line(d,[0,a],[0,0],s,p,l,C):0===a?AmCharts.line(d,[0,0],[0,b],s,p,l,C):0<E?AmCharts.rect(d,
a,b,u,f,l,s,p,E,c,C):AmCharts.polygon(d,[0,0,a,a,0],[0,b,b,0,0],u,f,l,s,p,c,!1,C);a=isNaN(y)?0>b?[D,t,H,z,G,I,h,m,A,d]:[m,A,H,z,G,I,D,t,h,d]:J?0<a?[D,d,m]:[m,d,D]:0>b?[D,d,m]:[m,d,D];for(b=0;b<a.length;b++)(n=a[b])&&g.push(n);F&&d.pattern(F)},width:function(g){this.w=Math.round(g);this.draw()},height:function(g){this.h=Math.round(g);this.draw()},animateHeight:function(g,d){var a=this;a.easing=d;a.totalFrames=Math.round(1E3*g/AmCharts.updateRate);a.rh=a.h;a.frame=0;a.height(1);setTimeout(function(){a.updateHeight.call(a)},
AmCharts.updateRate)},updateHeight:function(){var g=this;g.frame++;var d=g.totalFrames;g.frame<=d&&(d=g.easing(0,g.frame,1,g.rh-1,d),g.height(d),setTimeout(function(){g.updateHeight.call(g)},AmCharts.updateRate))},animateWidth:function(g,d){var a=this;a.easing=d;a.totalFrames=Math.round(1E3*g/AmCharts.updateRate);a.rw=a.w;a.frame=0;a.width(1);setTimeout(function(){a.updateWidth.call(a)},AmCharts.updateRate)},updateWidth:function(){var g=this;g.frame++;var d=g.totalFrames;g.frame<=d&&(d=g.easing(0,
g.frame,1,g.rw-1,d),g.width(d),setTimeout(function(){g.updateWidth.call(g)},AmCharts.updateRate))}});