class MainsController < ApplicationController
  def index
    @q = Main.ransack(params[:q])
    @mains = @q.result(distinct: true).all.page(params[:page]).per(10)
  end
end
