class FoodsController < ApplicationController

  def index
  end

  def select; end

  def result
    @main = Main.all
    binding.pry
    @main = params[:tag]
  end

  def genre_select; end
end
