/*
 Highcharts JS v7.1.1 (2019-04-09)

 (c) 2009-2019 Torstein Honsi

 License: www.highcharts.com/license
*/
(function(g) {
    "object" === typeof module && module.exports ? (g["default"] = g, module.exports = g) : "function" === typeof define && define.amd ? define("highcharts/modules/series-label", ["highcharts"], function(p) {
        g(p);
        g.Highcharts = p;
        return g
    }) : g("undefined" !== typeof Highcharts ? Highcharts : void 0)
})(function(g) {
    function p(w, g, t, p) {
        w.hasOwnProperty(g) || (w[g] = p.apply(null, t))
    }
    g = g ? g._modules : {};
    p(g, "modules/series-label.src.js", [g["parts/Globals.js"]], function(g) {
        function p(d, c, a, h, e, f) {
            d = (f - c) * (a - d) - (h - c) * (e - d);
            return 0 <
                d ? !0 : !(0 > d)
        }

        function t(d, c, a, h, e, f, b, k) {
            return p(d, c, e, f, b, k) !== p(a, h, e, f, b, k) && p(d, c, a, h, e, f) !== p(d, c, a, h, b, k)
        }

        function w(d, c, a, h, e, f, b, k) {
            return t(d, c, d + a, c, e, f, b, k) || t(d + a, c, d + a, c + h, e, f, b, k) || t(d, c + h, d + a, c + h, e, f, b, k) || t(d, c, d, c + h, e, f, b, k)
        }

        function B(d) {
            var c = this,
                a = Math.max(g.animObject(c.renderer.globalAnimation).duration, 250);
            c.labelSeries = [];
            c.labelSeriesMaxSum = 0;
            g.clearTimeout(c.seriesLabelTimer);
            c.series.forEach(function(h) {
                var e = h.options.label,
                    f = h.labelBySeries,
                    b = f && f.closest;
                e.enabled &&
                    h.visible && (h.graph || h.area) && !h.isSeriesBoosting && (c.labelSeries.push(h), e.minFontSize && e.maxFontSize && (h.sum = h.yData.reduce(function(a, b) {
                        return (a || 0) + (b || 0)
                    }, 0), c.labelSeriesMaxSum = Math.max(c.labelSeriesMaxSum, h.sum)), "load" === d.type && (a = Math.max(a, g.animObject(h.options.animation).duration)), b && (void 0 !== b[0].plotX ? f.animate({
                        x: b[0].plotX + b[1],
                        y: b[0].plotY + b[2]
                    }) : f.attr({
                        opacity: 0
                    })))
            });
            c.seriesLabelTimer = g.syncTimeout(function() {
                    c.series && c.labelSeries && c.drawSeriesLabels()
                }, c.renderer.forExport ?
                0 : a)
        }
        var C = g.addEvent,
            D = g.extend,
            x = g.isNumber,
            y = g.pick,
            z = g.Series,
            E = g.SVGRenderer,
            A = g.Chart;
        g.setOptions({
            plotOptions: {
                series: {
                    label: {
                        enabled: !0,
                        connectorAllowed: !1,
                        connectorNeighbourDistance: 24,
                        minFontSize: null,
                        maxFontSize: null,
                        onArea: null,
                        style: {
                            fontWeight: "bold"
                        },
                        boxesToAvoid: []
                    }
                }
            }
        });
        E.prototype.symbols.connector = function(d, c, a, h, e) {
            var f = e && e.anchorX;
            e = e && e.anchorY;
            var b, k, l = a / 2;
            x(f) && x(e) && (b = ["M", f, e], k = c - e, 0 > k && (k = -h - k), k < a && (l = f < d + a / 2 ? k : a - k), e > c + h ? b.push("L", d + l, c + h) : e < c ? b.push("L", d + l, c) :
                f < d ? b.push("L", d, c + h / 2) : f > d + a && b.push("L", d + a, c + h / 2));
            return b || []
        };
        z.prototype.getPointsOnGraph = function() {
            function d(a) {
                var b = Math.round(a.plotX / 8) + "," + Math.round(a.plotY / 8);
                p[b] || (p[b] = 1, e.push(a))
            }
            if (this.xAxis || this.yAxis) {
                var c = this.points,
                    a, h, e = [],
                    f, b, k, l;
                b = this.graph || this.area;
                k = b.element;
                var g = this.chart.inverted,
                    v = this.xAxis;
                a = this.yAxis;
                var r = g ? a.pos : v.pos,
                    g = g ? v.pos : a.pos,
                    v = y(this.options.label.onArea, !!this.area),
                    m = a.getThreshold(this.options.threshold),
                    p = {};
                if (this.getPointSpline && k.getPointAtLength &&
                    !v && c.length < this.chart.plotSizeX / 16) {
                    b.toD && (h = b.attr("d"), b.attr({
                        d: b.toD
                    }));
                    l = k.getTotalLength();
                    for (f = 0; f < l; f += 16) a = k.getPointAtLength(f), d({
                        chartX: r + a.x,
                        chartY: g + a.y,
                        plotX: a.x,
                        plotY: a.y
                    });
                    h && b.attr({
                        d: h
                    });
                    a = c[c.length - 1];
                    a.chartX = r + a.plotX;
                    a.chartY = g + a.plotY;
                    d(a)
                } else
                    for (l = c.length, f = 0; f < l; f += 1) {
                        a = c[f];
                        h = c[f - 1];
                        a.chartX = r + a.plotX;
                        a.chartY = g + a.plotY;
                        v && (a.chartCenterY = g + (a.plotY + y(a.yBottom, m)) / 2);
                        if (0 < f && (b = Math.abs(a.chartX - h.chartX), k = Math.abs(a.chartY - h.chartY), b = Math.max(b, k), 16 < b))
                            for (b =
                                Math.ceil(b / 16), k = 1; k < b; k += 1) d({
                                chartX: h.chartX + k / b * (a.chartX - h.chartX),
                                chartY: h.chartY + k / b * (a.chartY - h.chartY),
                                chartCenterY: h.chartCenterY + k / b * (a.chartCenterY - h.chartCenterY),
                                plotX: h.plotX + k / b * (a.plotX - h.plotX),
                                plotY: h.plotY + k / b * (a.plotY - h.plotY)
                            });
                        x(a.plotY) && d(a)
                    }
                return e
            }
        };
        z.prototype.labelFontSize = function(d, c) {
            return d + this.sum / this.chart.labelSeriesMaxSum * (c - d) + "px"
        };
        z.prototype.checkClearPoint = function(d, c, a, h) {
            var e = Number.MAX_VALUE,
                f = Number.MAX_VALUE,
                b, k, l = y(this.options.label.onArea, !!this.area),
                g = l || this.options.label.connectorAllowed,
                v = this.chart,
                r, m, p, t, q, n;
            for (q = 0; q < v.boxesToAvoid.length; q += 1)
                if (m = v.boxesToAvoid[q], n = d + a.width, r = c, p = c + a.height, !(d > m.right || n < m.left || r > m.bottom || p < m.top)) return !1;
            for (q = 0; q < v.series.length; q += 1)
                if (r = v.series[q], m = r.interpolatedPoints, r.visible && m) {
                    for (n = 1; n < m.length; n += 1) {
                        if (m[n].chartX >= d - 16 && m[n - 1].chartX <= d + a.width + 16) {
                            if (w(d, c, a.width, a.height, m[n - 1].chartX, m[n - 1].chartY, m[n].chartX, m[n].chartY)) return !1;
                            this === r && !b && h && (b = w(d - 16, c - 16, a.width + 32, a.height +
                                32, m[n - 1].chartX, m[n - 1].chartY, m[n].chartX, m[n].chartY))
                        }!g && !b || this === r && !l || (p = d + a.width / 2 - m[n].chartX, t = c + a.height / 2 - m[n].chartY, e = Math.min(e, p * p + t * t))
                    }
                    if (!l && g && this === r && (h && !b || e < Math.pow(this.options.label.connectorNeighbourDistance, 2))) {
                        for (n = 1; n < m.length; n += 1) b = Math.min(Math.pow(d + a.width / 2 - m[n].chartX, 2) + Math.pow(c + a.height / 2 - m[n].chartY, 2), Math.pow(d - m[n].chartX, 2) + Math.pow(c - m[n].chartY, 2), Math.pow(d + a.width - m[n].chartX, 2) + Math.pow(c - m[n].chartY, 2), Math.pow(d + a.width - m[n].chartX, 2) + Math.pow(c +
                            a.height - m[n].chartY, 2), Math.pow(d - m[n].chartX, 2) + Math.pow(c + a.height - m[n].chartY, 2)), b < f && (f = b, k = m[n]);
                        b = !0
                    }
                } return !h || b ? {
                x: d,
                y: c,
                weight: e - (k ? f : 0),
                connectorPoint: k
            } : !1
        };
        A.prototype.drawSeriesLabels = function() {
            var d = this,
                c = this.labelSeries;
            d.boxesToAvoid = [];
            c.forEach(function(a) {
                a.interpolatedPoints = a.getPointsOnGraph();
                (a.options.label.boxesToAvoid || []).forEach(function(a) {
                    d.boxesToAvoid.push(a)
                })
            });
            d.series.forEach(function(a) {
                function c(a, b, c) {
                    var d = Math.max(r, y(x, -Infinity)),
                        e = Math.min(r + t, y(z,
                            Infinity));
                    return a > d && a <= e - c.width && b >= m && b <= m + w - c.height
                }
                if (a.xAxis || a.yAxis) {
                    var e, f, b, k = [],
                        l, g, p = a.options.label,
                        r = (b = d.inverted) ? a.yAxis.pos : a.xAxis.pos,
                        m = b ? a.xAxis.pos : a.yAxis.pos,
                        t = d.inverted ? a.yAxis.len : a.xAxis.len,
                        w = d.inverted ? a.xAxis.len : a.yAxis.len,
                        q = a.interpolatedPoints,
                        n = y(p.onArea, !!a.area),
                        u = a.labelBySeries;
                    e = p.minFontSize;
                    f = p.maxFontSize;
                    var x, z;
                    n && !b && (b = [a.xAxis.toPixels(a.xData[0]), a.xAxis.toPixels(a.xData[a.xData.length - 1])], x = Math.min.apply(Math, b), z = Math.max.apply(Math, b));
                    if (a.visible &&
                        !a.isSeriesBoosting && q) {
                        u || (a.labelBySeries = u = d.renderer.label(a.name, 0, -9999, "connector").addClass("highcharts-series-label highcharts-series-label-" + a.index + " " + (a.options.className || "")).css(D({
                            color: n ? d.renderer.getContrast(a.color) : a.color
                        }, a.options.label.style)), e && f && u.css({
                            fontSize: a.labelFontSize(e, f)
                        }), u.attr({
                            padding: 0,
                            opacity: d.renderer.forExport ? 1 : 0,
                            stroke: a.color,
                            "stroke-width": 1,
                            zIndex: 3
                        }).add().animate({
                            opacity: 1
                        }, {
                            duration: 200
                        }));
                        e = u.getBBox();
                        e.width = Math.round(e.width);
                        for (g = q.length -
                            1; 0 < g; --g) n ? (f = q[g].chartX - e.width / 2, b = q[g].chartCenterY - e.height / 2, c(f, b, e) && (l = a.checkClearPoint(f, b, e))) : (f = q[g].chartX + 3, b = q[g].chartY - e.height - 3, c(f, b, e) && (l = a.checkClearPoint(f, b, e, !0)), l && k.push(l), f = q[g].chartX + 3, b = q[g].chartY + 3, c(f, b, e) && (l = a.checkClearPoint(f, b, e, !0)), l && k.push(l), f = q[g].chartX - e.width - 3, b = q[g].chartY + 3, c(f, b, e) && (l = a.checkClearPoint(f, b, e, !0)), l && k.push(l), f = q[g].chartX - e.width - 3, b = q[g].chartY - e.height - 3, c(f, b, e) && (l = a.checkClearPoint(f, b, e, !0))), l && k.push(l);
                        if (p.connectorAllowed &&
                            !k.length && !n)
                            for (f = r + t - e.width; f >= r; f -= 16)
                                for (b = m; b < m + w - e.height; b += 16)(l = a.checkClearPoint(f, b, e, !0)) && k.push(l);
                        if (k.length) {
                            if (k.sort(function(a, b) {
                                    return b.weight - a.weight
                                }), l = k[0], d.boxesToAvoid.push({
                                    left: l.x,
                                    right: l.x + e.width,
                                    top: l.y,
                                    bottom: l.y + e.height
                                }), k = Math.sqrt(Math.pow(Math.abs(l.x - u.x), 2), Math.pow(Math.abs(l.y - u.y), 2))) p = {
                                opacity: d.renderer.forExport ? 1 : 0,
                                x: l.x,
                                y: l.y
                            }, q = {
                                opacity: 1
                            }, 10 >= k && (q = {
                                x: p.x,
                                y: p.y
                            }, p = {}), a.labelBySeries.attr(D(p, {
                                anchorX: l.connectorPoint && l.connectorPoint.plotX +
                                    r,
                                anchorY: l.connectorPoint && l.connectorPoint.plotY + m
                            })).animate(q), a.options.kdNow = !0, a.buildKDTree(), a = a.searchPoint({
                                chartX: l.x,
                                chartY: l.y
                            }, !0), u.closest = [a, l.x - a.plotX, l.y - a.plotY]
                        } else u && (a.labelBySeries = u.destroy())
                    } else u && (a.labelBySeries = u.destroy())
                }
            });
            g.fireEvent(d, "afterDrawSeriesLabels")
        };
        C(A, "load", B);
        C(A, "redraw", B)
    });
    p(g, "masters/modules/series-label.src.js", [], function() {})
});
//# sourceMappingURL=series-label.js.map