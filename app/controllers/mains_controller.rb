class MainsController < ApplicationController
  def index
    @q = Main.ransack(params[:q])
    @mains = @q.result(distinct: true).all.page(params[:page]).per(10)
    if params[:q].present?
      @search = Main.ransack(params[:q])
      @datespots = @search.result
    else
    # 検索フォーム以外からアクセスした時の処理（デフォルトの並び順）
      params[:q] = { sorts: 'date asc' }
      @search = Main.ransack(params[:q])
      @datespots = @search.result
    end
  end
end
