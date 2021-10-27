class SubsController < ApplicationController
  def index
    @q = Sub.ransack(params[:q])
    @subs = @q.result(distinct: true).all.page(params[:page]).per(15)
  end
end
