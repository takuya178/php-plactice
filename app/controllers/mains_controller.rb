class MainsController < ApplicationController
  def index
    @q = Main.ransack(params[:q])
    @mains = @q.result(distinct: true).all.page(params[:page])
  end

  def show
    @main = Main.find(params[:id])
  end

  def new
    @main = Main.new
    @main.subs.build
  end

  def create
    @main = Main.new(main_params)
    if @main.save
      redirect_to new_main_path, success: '組み合わせを追加しました'
    else
      flash.now[:danger] = '組み合わせの追加に失敗しました'
      render :new
    end
  end

  private

  def main_params
    params.require(:main).permit(:name, :image, :calorie, :sugar, :lipid, :salt, :genre, subs_attributes:[:name, :image, :calorie, :sugar, :lipid, :salt])
  end

end
