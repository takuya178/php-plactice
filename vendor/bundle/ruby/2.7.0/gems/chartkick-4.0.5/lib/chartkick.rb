# modules
require "chartkick/enumerable"
require "chartkick/helper"
require "chartkick/version"

# integrations
require "chartkick/engine" if defined?(Rails)
require "chartkick/sinatra" if defined?(Sinatra)

if defined?(ActiveSupport.on_load)
  ActiveSupport.on_load(:action_view) do
    include Chartkick::Helper
  end
end

module Chartkick
  class << self
    attr_accessor :content_for
    attr_accessor :options
  end
  self.options = {}
end

Chartkick.options = {
  width: '300px',
  colors: ["#4242ff", "#ffd1a3", "#ffd1a3"],
  message: {empty: "データがありません"},
  thousands: ",", 
  legend: false, # 凡例非表示
  library: { # ここからHighchartsのオプション
    title: { # タイトル表示(ここでは、グラフの真ん中に配置して,viewでデータを渡しています。*後述)
      align: 'center',
      verticalAlign: 'middle',
    },
    xAxis: {
      visible: false
    },
    yAxis: {
      visible: false
    },
    chart: {
      backgroundColor: 'none',
      plotBorderWidth: 0, 
      plotShadow: false
    },
    plotOptions: {
      bar: {
        dataLabels: {
          enabled: true, 
          distance: -40, # ラベルの位置調節
          allowOverlap: false, # ラベルが重なったとき、非表示にする
          style: { #ラベルフォントの設定
            color: '#555', 
            textAlign: 'center', 
            textOutline: 0, #デフォルトではラベルが白枠で囲まれていてダサいので消す
          }
        },

      }
    },
  }
}