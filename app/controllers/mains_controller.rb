class MainsController < ApplicationController
  skip_before_action :require_login

  def index
    @q = Main.ransack(params[:q])
    @mains = @q.result(distinct: true).all.page(params[:page]).per(10)
  end
end
