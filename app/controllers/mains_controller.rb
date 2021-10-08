class MainsController < ApplicationController
  def index
    @mains = Main.all.page(params[:page]).per(10)
  end
end
