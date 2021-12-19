const chart = new Chartisan({
    el: '#chartConfirmado',
    url: "@chart('hold_chart')",
    hooks: new ChartisanHooks()
        .tooltip()
        .colors()
        .datasets('pie')
        .axis(false)
});
const charter = new Chartisan({
    el: '#chartRealizado',
    url: "@chart('finished_chart')",
    hooks: new ChartisanHooks()
        .legend()
        .tooltip()
        .colors()
        .datasets('line')
        .axis(true)
});
const tipos = new Chartisan({
    el: '#tiposchart',
    url: "@chart('tipos_chart')",
    hooks: new ChartisanHooks()
        .tooltip()
        .colors()
        .datasets('pie')
        .axis(false)

});