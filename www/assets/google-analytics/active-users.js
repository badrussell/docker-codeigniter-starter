gapi.analytics.ready(function () {
    gapi.analytics.createComponent("ActiveUsers", {
        initialize: function () {
            this.activeUsers = 0
        }, execute: function () {
            this.polling_ && this.stop(), this.render_(), gapi.analytics.auth.isAuthorized() ? this.getActiveUsers_() : gapi.analytics.auth.once("success", this.getActiveUsers_.bind(this))
        }, stop: function () {
            clearTimeout(this.timeout_), this.polling_ = !1, this.emit("stop", {activeUsers: this.activeUsers})
        }, render_: function () {
            var e = this.get();
            this.container = "string" == typeof e.container ? document.getElementById(e.container) : e.container, this.container.innerHTML = e.template || this.template, this.container.querySelector("b").innerHTML = this.activeUsers
        }, getActiveUsers_: function () {
            var e = this.get(), t = 1e3 * (e.pollingInterval || 5);
            if (isNaN(t) || 5e3 > t)throw new Error("Frequency must be 5 seconds or more.");
            this.polling_ = !0, gapi.client.analytics.data.realtime.get({ids: e.ids, metrics: "rt:activeUsers"}).execute(function (e) {
                var i = e.totalResults ? +e.rows[0][0] : 0, s = this.activeUsers;
                this.emit("success", {activeUsers: this.activeUsers}), i != s && (this.activeUsers = i, this.onChange_(i - s)), (this.polling_ = !0) && (this.timeout_ = setTimeout(this.getActiveUsers_.bind(this), t))
            }.bind(this))
        }, onChange_: function (e) {
            var t = this.container.querySelector("b");
            t && (t.innerHTML = this.activeUsers), this.emit("change", {activeUsers: this.activeUsers, delta: e}), e > 0 ? this.emit("increase", {
                activeUsers: this.activeUsers,
                delta: e
            }) : this.emit("decrease", {activeUsers: this.activeUsers, delta: e})
        //}, template: '<div class="ActiveUsers">No momento: <br><b class="ActiveUsers-value"></b><br>usuários ativos no site</div>'
            }, template: '<div class="ActiveUsers"><div class="small-box bg-aqua"><div class="inner"><h3><b class="ActiveUsers-value">150</b></h3><p>Usuários ativos no momento</p></div><div class="icon"><i class="fa fa-clock-o"></i></div></div></div>'
    })
});
//# sourceMappingURL=active-users.js.map