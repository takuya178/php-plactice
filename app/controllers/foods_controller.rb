class FoodsController < ApplicationController

  def index
    @sugar = params[:sugar]
    @lipid = params[:lipid]
    @salt = params[:salt]
  end

  def select; end

  def result; end

  def genre_select; end
end
