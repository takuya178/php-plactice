class MainsController < ApplicationController
  def index
    @q = Main.ransack(params[:q])
    @mains = @q.result(distinct: true).all.page(params[:page]).per(10)
    if params[:q].present?
      @search = Main.ransack(params[:q])
    else
      params[:q] = { sorts: 'date asc' }
      @search = Main.ransack(params[:q])
    end
  end
end
