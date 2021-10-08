require("@rails/ujs").start()
require("turbolinks").start()
require("@rails/activestorage").start()
require("channels")
require("jquery")
require("chartkick").use(require("highcharts"))

const images = require.context('../images', true)
const imagePath = (name) => images(name, true)

// yarnでインストールしたもの
import 'bootstrap'
import '../src/application.scss'
import "chartkick/highcharts"
