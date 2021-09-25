class Admin::MainsController < Admin::BaseController
  before_action :set_main, only: %i[show edit update destroy]

  def index
    @q = Main.ransack(params[:q])
    @mains = @q.result.all
  end

  def new
    @main = Main.new
  end

  def create
    @main = Main.new(main_params)

    if @main.save
      redirect_to new_admin_main_path, success: 'おつまみを追加しました'
    else
      flash.now[:danger] = 'おつまみを追加に失敗しました'
      render :new
    end
  end

  def edit; end

  def show; end

  def update
    if @main.update(main_params)
      redirect_to admin_main_path(@main), success: '更新に成功しました'
    else
      flash.now[:danger] = '更新に失敗しました'
      render :edit
    end
  end

  def destroy; end

  private

  def main_params
    params.require(:main).permit(:name, :image, :calorie, :sugar, :lipid, :salt)
  end

  def set_main
    @main = Main.find(params[:id])
  end
end
